// Generated by CoffeeScript 1.8.0
(function($) {
  var $container;
  $container = $('#masonry');
  if ($container.length) {
    $container.packery({
      itemSelector: '.tile',
      columnWidth: '.sizer',
      gutter: 0
    });
  }
  $(document.body).on('post-load', function() {
    $container.packery('reloadItems');
    return $container.packery();
  });
  $('iframe', '.e-content').parent('p').addClass('media');
})(jQuery);
