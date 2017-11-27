var shippingScript = {
  initAlerts: function($) {
    var alerts = $('.toppage-slider');
    if( alerts.length )
    {
      setTimeout(function(){
        alerts.slideDown( "slow", function() {
          // Animation complete.
        });
      }, 1500);
    }
    else
    {
      alerts.hide('slow');
    }
    $(document).on('click', '.alert-close-icon', function(){
      $('.toppage-slider').slideUp( "slow", function() {
        // Animation complete.
      });
    });
  },
  initFormSelect: function($) {
    //var count = $("select#country :selected").length;
    //alert(count);
    var selectedValue = $('select#country').val();
    if( selectedValue == 0 || selectedValue == "" )
    {
      console.log('selectedValue = '+selectedValue);
      $("select#country").val('pl').attr('style', 'background-image: url(/img/ico/ico-pl.png)');
      //alert('xxx');
      //$("select#country").change();
    }
    $(document).on('change', 'select#country', function(){
      //console.log('select change');
      var newValue = $(this).val();
      $(this).attr('style', 'background-image: url(/img/ico/ico-'+newValue+'.png)');

      //ajax
      $.ajax({
        method: "POST",
        url: URL_CHANGE_COUNTRY,
        data: { iso: newValue }
      }).done(function(data) 
      {
        $('#delivery-container').html('');
        if( data.status == 'success' )
        {
          $('#delivery-option-template').tmpl(data.response).appendTo('#delivery-container');
        }
      });
    });
  },
  initDeliveryTypeSelected: function($) {
    $('input[name="delivery_type"]').on('change', function(){
      shippingScript.updateTotalPrice($);
    });
  },
  updateTotalPrice: function($) {
    var deliveryPrice = 0;;
    if( $('input[name="delivery_type"]:checked').length )
    {
      deliveryPrice = $('input[name="delivery_type"]:checked').data('price')*1;
    }
    
    console.log('deliveryPrice = '+deliveryPrice);
    $('#summary_shipping').html( parseFloat( deliveryPrice ).toFixed(2) );
    var cartPrice = $('#summary_products').html();
    var totalPrice = parseFloat(cartPrice) + parseFloat(deliveryPrice);
    $('#summary_to_pay').html( parseFloat( totalPrice ).toFixed(2) );
  },
  initCheckboxToggle: function($) {
    $('#save_address').on('click', function(){
      //$('#address_name_div').toggle('slow');
    });
  },
  init: function($) {
    shippingScript.initAlerts($);
    shippingScript.initFormSelect($);
    shippingScript.initCheckboxToggle($);
    shippingScript.initDeliveryTypeSelected($);
    shippingScript.updateTotalPrice($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  shippingScript.init($);
});
//