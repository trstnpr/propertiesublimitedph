/**
 * Website js scripts init
 */

jQuery( document ).ready(function($) {
  'use strict';


  $('#cssmenu').prepend('<div id="menu-button">Menu</div>');
  $('#cssmenu #menu-button').on('click', function(){
    var menu = $(this).next('ul');
    if (menu.hasClass('open')) {
      menu.removeClass('open');
    } else {
      menu.addClass('open');
    }
  });

var $container = $('.masonry').imagesLoaded( function() {
//var $container = $('.masonry');
$container.imagesLoaded(function(){
$container.masonry({
  // options
  columnWidth: 1,
  itemSelector: '.masonry-col-3-12',
  percentPosition: true,
  //columnWidth: 200
});});});

} );