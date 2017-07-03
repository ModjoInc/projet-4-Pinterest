// external js: isotope.pkgd.js, imagesloaded.pkgd.js


// init Isotope after all images have loaded
var $grid = $('.grid').imagesLoaded( function() {
  $grid.isotope({
    itemSelector: '.grid-item',
    percentPosition: true
  });
});
