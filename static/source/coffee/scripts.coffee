container = document.getElementById 'masonry'
if container?
  msnry = new Packery container, {
    itemSelector: '.tile'
    columnWidth: '.sizer'
    gutter: 0
  }
