@extends('layouts.admin.main')

@section('title', 'Create | Product')

@section('vendor_css')
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('admins/assets/vendor/linearicons/style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="main-content">
		<div class="container-fluid">
			<h2 class="page-title">Product</h2>
			<!-- FORM -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Create Product</h3>
				</div>
				<div class="panel-body">
					<form id="createForm" action="{{ route('admin.products.store')}}" method="POST" enctype='multipart/form-data'>
						@csrf

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">       
                    				<label for="name">Name</label>
                    				<input type="text" class="form-control" id="name" name="name" placeholder="Please enter product name">
            					</div> 
							</div>
							<div class="col-md-6">
								<div class="form-group">       
                    				<label for="subcategoryId">Category</label>
                    				<select name="subcategory_id" id="subcategoryId" class="form-control" style="width: 100%">
										<option value="">Choose...</option>
										<option value="21">Choose color</option>
									</select>
            					</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">       
                    				<label for="price">Price</label>
                    				<input type="text" class="form-control" id="price" name="price" placeholder="Please enter product price">
            					</div> 
							</div>
							<div class="col-md-6">
								<div class="form-group">       
                    				<label for="discount">Discount</label>
                    				<input type="text" class="form-control" id="discount" name="discount" placeholder="Please enter product discount">
            					</div> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="prod_image">Images</label>
								<div class="metric">
									<div class="product-img-preview"></div>
									<div class="parent-upload">
										<label class="btn btn-success"><i class="fa fa-upload"></i> Choose images</label>
										<input type="file" id="image" name="prod_images[]"
    											    accept=".jpg, .jpeg, .png" onchange="imagesPreview(this, 'div.product-img-preview');" multiple required>		
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">  
									<label for="description">Description</label>
									<textarea id="description" name="description" required></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="productAttribute">Product attributes</label>
								<table class="table table-bordered" id="attributeTable">
    								<tr>
    									<th class="text-center">Image</th>
    							   		<th class="text-center">Color</th>
    							   		<th class="text-center">Size</th>
										<th class="text-center">Quantity</th>
    							   		<th class="text-center"><button type="button" name="addItem" class="btn btn-success btn-sm add">
											   <span class="glyphicon glyphicon-plus"></span>
											</button>
										</th>
    							  	</tr>
									<tr>
										<td class="text-center">
											<div class="attr-preview-0"></div>
											<div class="parent-upload">
												<label class="btn btn-success"><i class="fa fa-upload"></i></label>
    									    	<input type="file" name="attr_images[0]"
													onchange="imagesPreview(this, 'div.attr-preview-0');"
    									    	  	accept=".jpg, .jpeg, .png" required>
											</div>
    									</td>
										<td>
    									    <select name="colors[0]" class="form-control" required>
    									        <option value="">Choose color</option>
    									        <option value="2"> color</option>
    									    </select>
    									</td>
    									<td>
    									    <select name="sizes[0]" class="form-control" required>
    									        <option value="">Choose size</option>
    									        <option value="3"> color</option>
    									    </select>
    									</td>
    									<td>
    									    <input type="number" name="quantities[0]" min="0" max="99999" class="form-control" required>
    									</td>
    									<td></td>
									</tr>
    							</table>
							</div>
						</div>
						<button type="submit" class="btn btn-primary pull-right">Save changes</button>
					</form>
				</div>
			</div>
		</div>				
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('admins/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admins/assets/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('admins/assets/scripts/klorofil-common.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script type="text/javascript">
	function imagesPreview(input, placeToInsertImagePreview) {
		if (input.files) {
			var filesAmount = input.files.length;
			$(placeToInsertImagePreview).empty();
			for (i = 0; i < filesAmount; i++) {
				var reader = new FileReader();
				reader.onload = function(event) {
					$($.parseHTML('<img>')).attr({'src': event.target.result,'width': '80px','style': 'margin: 20px'}).appendTo(placeToInsertImagePreview);
				}
				reader.readAsDataURL(input.files[i]);
			}
		}
	};
	$(document).ready(function() {
		// using ck editor
		var editor = CKEDITOR.replace('description');
		// using select2
		$('#subcategoryId').select2({
			selectOnClose: true,
		});
		$('#colorId').select2({
			selectOnClose: true,
		});
		/*
    	 * When you change the value the select via select2, it triggers
    	 * a 'change' event, but the jquery validation plugin
    	 * only re-validates on 'blur'
    	 */
    	$('#subcategoryId').on('change', function() {
    	  $(this).trigger('blur');
    	});
		$('input[type=file]').on('change', function() {
    	  $(this).trigger('blur');
    	});
		// $('#createForm').submit(function(e){
    	// 	e.preventDefault();
  		// });
		// validate form
		$('#createForm').validate({
			rules: {
				ignore: [],
				name: {
					required: true,
					maxlength: 255
				},
				subcategory_id: {
					required: true,
				},
				price: {
					required: true,
					number: true,
					maxlength: 16
				},
				discount: {
					required: true,
					number: true,
					range: [1, 100]
				}		
			},
			errorPlacement: function(error, element) {
				// console.log(element);
    			if (element.is('#subcategoryId')) {
    	    		error.insertAfter(element.next('.select2-container'));	
					console.log(1);
    			}
				else if(element.is('input[type=file]')) {
					error.insertAfter(element.parent());
				}
				else
				{
    	    		error.insertAfter(element);
					console.log(3);
    			}
			}
		});

 		// select box fields dynamically
		 var i = 0;
 		$(document).on('click', '.add', function(){
			var html = '';	
			i++;
			var classImg = `'div.attr-preview-${i}'`;
			html += '<tr>';
			html += '<td class="text-center"><div class="attr-preview-'+ i +'"></div><div class="parent-upload">';
			html +=	'<label class="btn btn-success"><i class="fa fa-upload"></i></label>';
			html += '<input type="file" name="attr_images['+ i +']" onchange="imagesPreview(this,'+ classImg +');" accept=".jpg, .jpeg, .png" required></div>';
			html += '</td>'
			html += '<td><select name="colors['+ i +']" class="form-control" required><option value="">Choose color</option></select></td>';
			html += '<td><select name="sizes['+ i +']" class="form-control"required><option value="">Choose size</option></select></td>';
			html += '<td><input type="number" name="quantities['+ i +']" min="0" max="99999" class="form-control" required></td>';		
			html += '<td class="text-center"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
			$('#attributeTable').append(html);

			$('input[type=file]').on('change', function() {
    	  		$(this).trigger('blur');
    		});


 		});
 		$(document).on('click', '.remove', function(){
			$(this).closest('tr').remove();
 		});
		 // toastr options
		toastr.options = {
			'preventDuplicates': true,
			'preventOpenDuplicates': true
		};
	});
</script>
@endsection