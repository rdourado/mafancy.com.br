### global myAjax ###
(($) ->

  $.ajax {
    type: 'post'
    dataType: 'json'
    url: myAjax.ajaxurl
    data: {
      action: 'my_view_count'
      post_id: myAjax.post_id
      nonce: myAjax.nonce
    }
  }

  return

) jQuery