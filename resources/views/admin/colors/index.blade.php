@extends('layouts.admin.main')

@section('title', 'Color Attribute')

@section('vendor_css')
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/linearicons/style.css') }}">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="main-content">
		<div class="container-fluid">
			<h2 class="page-title">Color</h2>
			<div class="form-group">
				<div class="input-group">
					<button type="button" class="btn btn-primary" onclick="onCreate()">Create new</button>
				</div>
			</div>
			<!-- TABLE HOVER -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Color Table</h3>
				</div>
				<div class="panel-body">
					<table id="colorTable" class="table table-hover">
    					<thead>
    					    <tr>
    					        <th>#</th>
    					        <th>Name</th>
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
@include('admin.colors.create-edit-modal')
@include('layouts.admin.elements.delete-modal')
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('admins/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('admins/assets/scripts/klorofil-common.js') }}"></script>
<script src="{{ asset('admins/assets/scripts/convert_vi.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#colorTable').DataTable({
  			serverSide: true,
  			ajax:{
   				url: '{{ route('admin.colors.index') }}',
  			},
			columns: [
				{data:'DT_RowIndex'},
				{data:'name'},
				{data:'actions', orderable: false}
				
			]
		});
		
    });
</script>
<script type="text/javascript">

	function onCreate() {
		$('#createEditForm').validate().resetForm();
		$('#createEditForm').trigger('reset');
		$('#modalTitle').html('Create Color');		
		$('#createEditForm').attr('onsubmit', 'storeData()');	
		$('#createEditModal').modal('show');
	}
	function onEdit(event) {
		var id  = $(event).data('id');
    	let _url = '{{ route('admin.colors.show',':id')}}';
		_url = _url.replace(':id', id);
		$.ajax({
			url: _url,
			type: 'GET',
			success: function(response) {
				if(response) {
					$('#createEditForm').validate().resetForm();
					$('#modalTitle').html('Edit Color');
					$('#id').val(response.id);
					$('#name').val(response.name);
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
	function storeData() {
		var name = $('#name').val();
		let _url = '{{ route('admin.colors.store')}}';
		$.ajaxSetup({
    		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		});
		$.ajax({
			url: _url,
			type: 'POST',
			data: {
				name: name
        	},
			beforeSend: function(){
				$('#btnSave').html('Please wait...');
        		$('#btnSave').attr('disabled', true);
   			},
			success: function(response,textStatus, jqXHR) {
					if(jqXHR.status == 201) {

						$('#createEditModal').modal('hide');
						$('#btnSave').html('Save changes');
        				$('#btnSave').attr('disabled', false);
						toastr.success(response.message, 'Success')
						$('#colorTable').DataTable().ajax.reload(null, false);
					}
				
			},
			error: function(jqXHR) {  
               if(jqXHR.status&&jqXHR.status==422){
					var errors = $.parseJSON(jqXHR.responseText);
					var errorString = '';
					$.each(errors['errors'], function (key, value) {
						errorString += `<p>${value}</p>`;
        			});
					toastr.error(errorString, 'Error')

					$('#btnSave').html('Save changes');
        			$('#btnSave').attr('disabled', false); 
            	}
			   	else
			   	{
				   console.log(jqXHR.responseText);
			   	}
			}
    	});

	}
	function updateData() {
		var id  = $('#id').val();
		var name = $('#name').val();
		let _url = '{{ route('admin.colors.update',':id')}}';
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
				name: name
        	},
			beforeSend: function(){
				$('#btnSave').html('Please wait...');
        		$('#btnSave').attr('disabled', true);
   			},	
			success: function(response,textStatus, jqXHR) {
					if(jqXHR.status == 200) {
						$('#createEditModal').modal('hide');
						$('#btnSave').html('Save changes');
        				$('#btnSave').attr('disabled', false);

						toastr.success(response.message, 'Success')

						$('#colorTable').DataTable().ajax.reload(null, false);
					}
				
			},
			error: function(jqXHR) {  
               if(jqXHR.status&&jqXHR.status==422){
					var errors = $.parseJSON(jqXHR.responseText);
					var errorString = '';
					$.each(errors['errors'], function (key, value) {
						errorString += `<p>${value}</p>`;
        			});
					toastr.error(errorString, 'Error')
					$('#btnSave').html('Save changes');
        			$('#btnSave').attr('disabled', false); 
            	}
			}
    	});

	}
	function deleteData() {
		var id  = $('#delId').val();
		let _url = '{{ route('admin.colors.destroy',':id')}}';
		_url = _url.replace(':id', id);
		$.ajaxSetup({
    		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		});
		$.ajax({
			url: _url,
			type: 'DELETE',
			success: function(response,textStatus, jqXHR) {
					if(jqXHR.status == 200) {
						$('#deleteModal').modal('hide');
						toastr.success(response.message, 'Success')
						$('#colorTable').DataTable().ajax.reload(null, false);		
					}
			},
			error: function(jqXHR) {  
               if(jqXHR.status&&jqXHR.status==409) {
					$('#deleteModal').modal('hide');
					var errors = $.parseJSON(jqXHR.responseText);
					$.each(errors, function (key, value) {
						toastr.error(value, 'Error')
        			}); 
            	}
			}
    	});
	}
</script>
<script type="text/javascript">
	$('#createEditForm').submit(function(e){
    	e.preventDefault();
  	});
	//   validate form
	$('#createEditForm').validate({
		rules: {
			name: {
				required: true,
				maxlength: 50
			}
		}
		});
	$('#btnSave').click(function() {
 		if($('#createEditForm').valid()) {
			$('#createEditForm').submit();
		}
	});
	toastr.options = {
	'preventDuplicates': true,
	'preventOpenDuplicates': true
	};
</script>
@endsection