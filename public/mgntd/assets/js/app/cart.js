var cartScript = {
  initRemoveItem: function($) {
    $('.remove').on('click', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var token = '';
      confirmDialog(
        $(this).attr('data-message'), 
        $(this).attr('data-title'), 
        function() { cartScript.initRemove(id); });
    })
  },
  initRemove: function(id) {
    jQuery.ajax({
      url: URL_CART_UPDATE,
      type: 'POST',
      data: {
        id: id,
        action: 'delete'
      },
      success: function( msg ) {
        if ( msg.status === 'success' ) {
          //toastr.success( msg.response );
          window.location.href = msg.response;
        }
      },
      error: function( data ) {
        if ( data.status === 422 ) {
          //toastr.error('Cannot delete the item');
        }
      }
    });
  },
  initUpdateQuantity: function($) {
    $('.cart-qty').on('change', function(){
      $(this).prop('disabled', true);
      //alert( $(this).val() );
      jQuery.ajax({
        url: URL_CART_UPDATE,
        type: 'POST',
        data: {
          id: $(this).data('id'),
          quantity: $(this).val(),
          action: 'update'
        },
        success: function( msg ) {
          if ( msg.status === 'success' ) {
            window.location.href = msg.response;
          }
        },
        error: function( data ) {
          if ( data.status === 422 ) {
            //toastr.error('Cannot delete the item');
          }
        }
      });
    });
  },
  initPopups: function($) {
    $('.popup-link').magnificPopup({
      type: 'image'
      // other options
    });
  },
  init: function($) {
    cartScript.initRemoveItem($);
    cartScript.initPopups($);
    cartScript.initUpdateQuantity($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  cartScript.init($);
});