(function ($) {

    $(document).ready(function () {
        $('.image-remove-button').click(function() {
           //update flag remove
           $(this).next().val(1);
           //hide description and remove button
           var id = $(this).attr('id-field');
           $('.' + id + '-file').next().hide();
           $(this).hide();
        });
  
    });

})(jQuery);
