
(function ($) {
  Drupal.color = {
    logoChanged: false,
    callback: function(context, settings, form, farb, height, width) {
      // Change the logo to be the real one.
      if (!this.logoChanged) {
        $('#preview #preview-logo img').attr('src', Drupal.settings.color.logo);
        this.logoChanged = true;
      }
      // Remove the logo if the setting is toggled off. 
      if (Drupal.settings.color.logo == null) {
        $('div').remove('#preview-logo');
      }
      
      $('#preview', form).css('background-color', $('#palette input[name="palette[base]"]', form).val());
      var bg_preview = $('input[name="files[imgsite]"]').next().children().attr('src');
      $('#preview', form).css('background-image', 'url(' + bg_preview + ')');
      
      $('#preview-header', form).css('background-color', $('#palette input[name="palette[headerbg]"]', form).val());
      $('#preview-header', form).css('color', $('#palette input[name="palette[headertext]"]', form).val());
      $('#preview-header a', form).css('color', $('#palette input[name="palette[headerlinks]"]', form).val());
      var bg_preview = $('input[name="files[imgheader]"]').next().children().attr('src');
      $('#preview-header', form).css('background-image', 'url(' + bg_preview + ')');
      
      $('#preview-main', form).css('background-color', $('#palette input[name="palette[contentbg]"]', form).val());
      $('#preview-main', form).css('color', $('#palette input[name="palette[contenttext]"]', form).val());
      $('#preview-main a', form).css('color', $('#palette input[name="palette[contentlinks]"]', form).val());
      var bg_preview = $('input[name="files[imgcontent]"]').next().children().attr('src');
      $('#preview-main', form).css('background-image', 'url(' + bg_preview + ')');
      
      $('#preview-footer-wrapper', form).css('background-color', $('#palette input[name="palette[footerbg]"]', form).val());
      $('#preview-footer-wrapper', form).css('color', $('#palette input[name="palette[footertext]"]', form).val());
      $('#preview-footer-wrapper a', form).css('color', $('#palette input[name="palette[footerlinks]"]', form).val());
      var bg_preview = $('input[name="files[imgfooter]"]').next().children().attr('src');
      $('#preview-footer-wrapper', form).css('background-image', 'url(' + bg_preview + ')');
    }
  };
})(jQuery);
