(($)->

  $container = $ '#masonry'
  if $container.length
    $container.packery {
      itemSelector: '.tile'
      columnWidth: '.sizer'
      gutter: 0
    }

  $ document.body
    .on 'post-load', ->
      $container.packery 'reloadItems'
      $container.packery()

  $ 'iframe', '.e-content'
    .parent 'p'
    .addClass 'media'

  return
) jQuery