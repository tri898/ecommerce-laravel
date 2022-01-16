@extends('layouts.admin.main')

@section('title', 'Attributes')

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
			<h2 class="page-title">Attributes</h2>
			<div class="form-group">
				<div class="input-group">
					<button type="button" class="btn btn-primary" onclick="onCreate()">Create new</button>
				</div>
			</div>
			<!-- TABLE HOVER -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Attribute Table</h3>
				</div>
				<div class="panel-body">
					<table id="attributeTable" class="table table-hover">
    					<thead>
    					    <tr>
    					        <th>#</th>
    					        <th>Name</th>
    					        <th>Created at</th>
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
@include('admin.attributes.create-edit-modal')
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
@include('admin.attributes.script')
@endsection