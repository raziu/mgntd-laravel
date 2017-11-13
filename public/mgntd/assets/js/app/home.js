var homeScript = {
  newsletterSignup: function($) {
    $('.newsletter-message').hide();
    $('#newsletter-submit').click(function(e) {
      e.preventDefault();
      $.post(LOCALE+'subscribers/submit', {
        email: $('input[name="newsletter-email"]').val()
        }, 
        function($data){
          if($data.status == 'success') {
            $('.newsletter-message').hide().removeClass('success error').addClass('success').html($data.response).fadeIn('slow');
            $('input[name="newsletter-email"]').val('');
            //hide message
            setTimeout(function(){ $('.newsletter-message').fadeOut('slow'); }, 3000);
          } else {
            $('.newsletter-message').hide().removeClass('success error').addClass('error').html($data.response).fadeIn('slow');
          }
        });
      });
      //We prevented to submit by pressing enter or another way
      $('form').submit(function(e){
        e.preventDefault();
        $('#newsletter-submit').click();
      });
  },
  init: function($) {
    console.log('home.js init');
    homeScript.newsletterSignup($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  homeScript.init($);
  /*var _ouibounce = ouibounce(document.getElementById('erte-ouibounce-modal'), {
    //sensitivity: 10,
    aggressive: true, //each page reloads or cookie (false)
    timer: 0,
    //delay: 100, //delay to show modal
    //cookieExpire: 10,
    //cookieDomain: '.example.com', 
    //cookieName: 'customCookieName',
    //sitewide: true
    callback: function() { console.log('ouibounce fired!'); }
  });*/
  /*
  var modal = ouibounce(document.getElementById('ouibounce-modal'));
  modal.fire(); // fire the ouibounce event
  modal.disable() // disable ouibounce, it will not fire on page exit
  modal.disable({ cookieExpire: 50, sitewide: true }) // disable ouibounce sitewide for 50 days. 
  */
});