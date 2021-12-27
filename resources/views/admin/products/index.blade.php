@extends('layouts.admin.main')

@section('title', 'Product')

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
			<h2 class="page-title">Product</h2>
			<div class="form-group">
				<div class="input-group">
					<a href="{{ route('admin.products.create')}}" class="btn btn-primary">Create new</a>
				</div>
			</div>
			<!-- TABLE HOVER -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Product Table</h3>
				</div>
				<div class="panel-body">
					<table id="categoryTable" class="table table-hover">
    					<thead>
    					    <tr>
    					        <th>#</th>
    					        <th>Name</th>
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
@include('layouts.admin.elements.delete-modal')
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('admins/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('admins/assets/scripts/klorofil-common.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#categoryTable').DataTable({
  			serverSide: true,
  			ajax:{
   				url: '{{ route('admin.categories.index') }}',
  			},
			columns: [
				{data:'DT_RowIndex'},
				{data:'name'},
				{data:'slug', orderable: false},
				{data:'actions', orderable: false}
				
			]
		});
		
    });
</script>
<script type="text/javascript">

	function onDelete(event) {
		$('#delId').val($(event).data('id'));
		$('#deleteModal').modal('show');
	}
	function deleteData() {
		var id  = $('#delId').val();
		let _url = '{{ route('admin.categories.destroy',':id')}}';
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
						$('#categoryTable').DataTable().ajax.reload(null, false);		
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
@endsection