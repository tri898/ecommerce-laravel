<script type="text/javascript">
function imagesPreview(input, placeToInsertImagePreview) {
    if (input.files) {
        var filesAmount = input.files.length;
        $(placeToInsertImagePreview).empty();
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {
                $($.parseHTML('<img>')).attr({
                    'src': event.target.result,
                    'width': '80px',
                    'style': 'margin: 20px'
                }).appendTo(placeToInsertImagePreview);
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
};
$(document).ready(function() {
 // using ck editor
    var editor = CKEDITOR.replace('content');

});
</script>