var paymentScript = {
  initDotpayPayment: function($) {
    $('.dotpay-link').on('click', function() {
      jQuery.blockUI();
      jQuery.ajax({
        method: "POST",
        url: URL_MAKE_PAYMENT,
        data: { 
          canal: jQuery(this).data('canal'), 
          type: jQuery(this).data('type'),
          hash: jQuery(this).data('hash')
        }
      }).done(function(data) 
      {
        if( data.status == 'success' )
        {
          //append data form to body
          //and make form post
          paymentScript.post_to_url(data.url, data.response, 'post');
        }
        else
        {
          //show error
          alert( 'Error: '+data.response );
        }
      });
    });
  },
  post_to_url: function(path, params, method) {
    method = method || "post";
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    form.setAttribute("id", params.form_id);
    for(var key in params) {
      if(params.hasOwnProperty(key)) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
      }
    }
    document.body.appendChild(form);
    form.submit();
  },
  init: function($) {
    paymentScript.initDotpayPayment($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  paymentScript.init($);
});