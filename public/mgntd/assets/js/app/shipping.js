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
      console.log('select change');
      var newValue = $(this).val();
      $(this).attr('style', 'background-image: url(/img/ico/ico-'+newValue+'.png)');
    });
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
  }
};
jQuery(document).ready(function($) {
  "use strict";
  shippingScript.init($);
});
//