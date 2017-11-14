var productScript = {
  initGridSquares: function($) {
    $('body').on('mouseover', '.add_to_set', function(){
      $( this ).find(".square-content").removeClass('hidden');
    });
    $('body').on('mouseout', '.add_to_set', function(){
      $( this ).find(".square-content").addClass('hidden');
    });
  },
  init: function($) {
    productScript.initGridSquares($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  productScript.init($);
});