@extends('layouts.admin.main')

@section('title', 'SubCategory')

@section('vendor_css')
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/linearicons/style.css') }}">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <h2 class="page-title">Subcategory</h2>
        <div class="form-group">
            <div class="input-group">
                <button type="button" class="btn btn-primary" onclick="onCreate()">Create new</button>
            </div>
        </div>
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Subcategory Table</h3>
            </div>
            <div class="panel-body">
                <table id="subcategoryTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent Category</th>
                            <th>Slug</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.subcategories.create-edit-modal')
@include('layouts.admin.elements.delete-modal')
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('admins/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('admins/assets/scripts/klorofil-common.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // get data to table
    $('#subcategoryTable').DataTable({
        serverSide: true,
        ajax: {
            url: '{{ route('admin.subcategories.index') }}',
        },
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'name'
            },
            {
                data: 'category.name'
            },
            {
                data: 'slug',
                orderable: false
            },
            {
                data: 'actions',
                orderable: false
            }
        ],
        columnDefs: [
            {
                "targets": [1,2,3,4] , 
                "className": "text-center"
            }
        ]
    });
    //add data to select option
    getCategories();
});
</script>
<script type="text/javascript">
function onCreate() {
    $('#createEditForm').validate().resetForm();
    $('#createEditForm').trigger('reset');
    $('#categoryId').val(null).trigger('change');
    $('#modalTitle').html('Create Subcategory');
    $('#createEditForm').attr('onsubmit', 'storeData()');
    $('#createEditModal').modal('show');
}

function onEdit(event) {
    var id = $(event).data('id');
    let _url = '{{ route('admin.subcategories.show',': id ')}}';
    _url = _url.replace(':id', id);
    $.ajax({
        url: _url,
        type: 'GET',
        success: function(response) {
            if (response) {
                $('#createEditForm').validate().resetForm();
                $('#modalTitle').html('Edit Subcategory');
                $('#id').val(response.id);
                $('#name').val(response.name);
                $("#categoryId").val(response.category_id).trigger('change');
                $('#createEditForm').attr('onsubmit', 'updateData()');
                $('#createEditModal').modal('show');
            }
        }
    });
}

function onDelete(event) {
    $('#delId').val($(event).data('id'));
    $('#deleteModal').modal('show');
}

function getCategories() {
    let _url = '{{ route('admin.categories.list') }}';
    $.ajax({
        url: _url,
        type: 'GET',
        success: function(response) {
            if (response) {
                $.each(response, function(key, value) {
                    $('#categoryId').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            }
        }
    });
}

function storeData() {
    var name = $('#name').val();
    var category_id = $("#categoryId").val();
    let _url = '{{ route('admin.subcategories.store')}}';
    _url = _url.replace(':id', id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: _url,
        type: 'POST',
        data: {
            name: name,
            category_id: category_id
        },
        beforeSend: function() {
            $('#btnSave').html('Please wait...');
            $('#btnSave').attr('disabled', true);
        },
        success: function(response, textStatus, jqXHR) {
            if (jqXHR.status == 201) {

                $('#createEditModal').modal('hide');
                $('#btnSave').html('Save changes');
                $('#btnSave').attr('disabled', false);
                toastr.success(response.message, 'Success')
                $('#subcategoryTable').DataTable().ajax.reload(null, false);
            }

        },
        error: function(jqXHR) {
            if (jqXHR.status && jqXHR.status == 422) {
                var errors = $.parseJSON(jqXHR.responseText);
                var errorString = '';
                $.each(errors['errors'], function(key, value) {
                    errorString += `<p>${value}</p>`;
                });
                toastr.error(errorString, 'Error')

                $('#btnSave').html('Save changes');
                $('#btnSave').attr('disabled', false);
            } else {
                console.log(jqXHR);
            }
        }
    });

}

function updateData() {
    var id = $('#id').val();
    var name = $('#name').val();
    var category_id = $("#categoryId").val();
    let _url = '{{ route('admin.subcategories.update',':id')}}';
    _url = _url.replace(':id', id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: _url,
        type: 'PUT',
        data: {
            name: name,
            category_id: category_id
        },
        beforeSend: function() {
            $('#btnSave').html('Please wait...');
            $('#btnSave').attr('disabled', true);
        },
        success: function(response, textStatus, jqXHR) {
            if (jqXHR.status == 200) {
                $('#createEditModal').modal('hide');
                $('#btnSave').html('Save changes');
                $('#btnSave').attr('disabled', false);

                toastr.success(response.message, 'Success')

                $('#subcategoryTable').DataTable().ajax.reload(null, false);
            }

        },
        error: function(jqXHR) {
            if (jqXHR.status && jqXHR.status == 422) {
                var errors = $.parseJSON(jqXHR.responseText);
                var errorString = '';
                $.each(errors['errors'], function(key, value) {
                    errorString += `<p>${value}</p>`;
                });
                toastr.error(errorString, 'Error')
                $('#btnSave').html('Save changes');
                $('#btnSave').attr('disabled', false);
            } else {
                console.log(jqXHR);
            }
        }
    });

}

function deleteData() {
    var id = $('#delId').val();
    let _url = '{{ route('admin.subcategories.destroy',':id')}}';
    _url = _url.replace(':id', id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: _url,
        type: 'DELETE',
        success: function(response, textStatus, jqXHR) {
            if (jqXHR.status == 200) {
                $('#deleteModal').modal('hide');
                toastr.success(response.message, 'Success')
                $('#subcategoryTable').DataTable().ajax.reload(null, false);
            }
        }
    });
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    // using select2
    $('#categoryId').select2({
        selectOnClose: true,
        dropdownParent: $('#createEditModal')
    });
    /*
     * When you change the value the select via select2, it triggers
     * a 'change' event, but the jquery validation plugin
     * only re-validates on 'blur'
     */
    $('#categoryId').on('change', function() {
        $(this).trigger('blur');
    });

    $('#createEditForm').submit(function(e) {
        e.preventDefault();
    });

    // validate form
    $('#createEditForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            categoryId: {
                required: true,
            }
        },
        errorPlacement: function(error, element) {
            if (element.is('#categoryId')) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#btnSave').click(function() {
        if ($('#createEditForm').valid()) {
            $('#createEditForm').submit();
        }
    });
    // toastr options
    toastr.options = {
        'preventDuplicates': true,
        'preventOpenDuplicates': true
    };
});
</script>
@endsection