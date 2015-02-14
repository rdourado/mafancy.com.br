(($)->

  $container = $ '#content'
  $container.packery {
    itemSelector: '.tile'
    columnWidth: '.sizer'
    gutter: 0
  } if $container.length

  $ document.body
    .on 'post-load', ->
      $container.packery 'reloadItems'
      $container.packery()

  $ 'iframe', '.e-content'
    .parent 'p'
    .addClass 'media'

  # Infinite Scroll

  max   = myIS.max
  query = myIS.query
  next  = $ '.next-posts'
  wait  = false
  query.paged++

  next.on 'click', (e) ->
    do e.preventDefault
    return if wait
    wait = true
    $.ajax {
      type: 'post'
      url: myIS.ajaxurl
      data: {
        action: 'my_infinite_scroll'
        nonce: myIS.nonce
        query: query
      }
      success: (response) ->
        wait = false
        if query.paged < max then query.paged++ else do next.remove
        $ '#content'
          .append response
        $ document.body
          .trigger 'post-load'
    }

  return
) jQuery