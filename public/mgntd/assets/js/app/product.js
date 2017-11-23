var tool = [
  'enhance',
  'effects',
  'frames',
  'orientation',
  'focus',
  /*'resize',*/
  'crop',
  'warmth',
  'brightness',
  'contrast',
  'saturation',
  'sharpness',
  'colorsplash',
  'draw',
  'text',
  'redeye',
  'whiten',
  'blemish'
];
var featherEditor = new Aviary.Feather({
  apiKey: AVK,
  apiVersion: 2,
  openType: 'lightbox',
  tools: tool,
  language: LANG,
  //noCloseButton: true,
  onSave: function (imageID, newURL) {
    jQuery.ajax({
        method: "POST",
        dataType: "json",
        url: LOCALE+"product/update-grid",
        data: {
            new_url: newURL,
            idx: setId,
            url: jQuery('#'+imageID).attr('data-url')
        }
    })
    .done(function( data ) {
      //Update grid element with new data
      var setId = imageID.replace('editable-','idx-');
      var editedPhotoSquare = jQuery("#"+setId);
      if( data.new_size.width == data.new_size.height )
      {
        editedPhotoSquare.attr('data-is-square', '1');
      }
      editedPhotoSquare.attr('data-width', data.new_size.width);
      editedPhotoSquare.attr('data-height', data.new_size.height);
      editedPhotoSquare.removeAttr("style").attr("style", 'background-image:url("'+newURL+'")');
      editedPhotoSquare.attr('data-url', newURL);
      // Close Aviary editor popup
      featherEditor.close();
      // Remove focus from link
      $(".add_to_set").blur();
    });
  }
});
var productScript = {
  initGridSquares: function($) {
    $('body').on('mouseover', '.add_to_set', function(){
      $( this ).find(".square-content").removeClass('hidden');
      if( $(this).attr('data-has-image') == "" )
      {
        var i = $(this).attr('data-i');
        $('.edit-'+i).hide();
        $('.remove-'+i).hide();
      }
      else
      {
        var i = $(this).attr('data-i');
        $('.edit-'+i).show();
        $('.remove-'+i).show();
      }
    });
    $('body').on('mouseout', '.add_to_set', function(){
      $( this ).find(".square-content").addClass('hidden');
    });
    //photo_to_add
    $('body').on('mouseover', '.photo_to_add', function(){
      $( this ).find(".square-content").removeClass('hidden');
    });
    $('body').on('mouseout', '.photo_to_add', function(){
      $( this ).find(".square-content").addClass('hidden');
    });
  },
  initTabs: function(e) {
    jQuery('#productViewTabs a').click(function (e) {
      e.preventDefault()
      jQuery(this).tab('show')
    })
  },
  initAwsUpload($) {
    var form = $('.awsUploadForm');
    var filesUploaded = [];
    var urlSuccess = URL_REDIRECT;
    var $progressContainer = $('#progress');
    var $progress = $progressContainer.find('.progress-bar');
    // Place any uploads within the descending folders
    // so ['test1', 'test2'] would become /test1/test2/filename
    var folders = [];
    form.fileupload({
      url: form.attr('action'),
      type: form.attr('method'),
      acceptFileTypes: /^image\/(gif|jpe?g|png)$/i,
      datatype: 'xml',
      process: function (e, data) 
      {
        //
      },
      add: function (event, data) 
      {
        var file = data.files[0];
        var hash = CryptoJS.MD5(file.name+'-'+Date.now());
        var filename = Date.now() + '-'+hash+'.' + file.name.split('.').pop();
        form.find('input[name="Content-Type"]').val(file.type);
        form.find('input[name="key"]').val((folders.length ? folders.join('/') + '/' : '') + filename);
        // Show warning message if your leaving the page during an upload.
        window.onbeforeunload = function () 
        {
          return 'you-have-unsaved-changes"';
        };
        var uploadErrors = [];
        var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
        if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) 
        {
          uploadErrors.push('not-an-accepted-file-type');
        }
        if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) 
        {
          uploadErrors.push('filesize-is-too-big');
        }
        if(uploadErrors.length > 0) 
        {
          alert(uploadErrors.join("\n"));
        } 
        else 
        {
          // Actually submit to form to S3.
          data.submit();
          $progressContainer.show();
          $progress.css('width', '0%');
          $progress.html('0%');
        }
      },
      progressall: function (e, data) 
      {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $progress.css('width', progress + '%');
        $progress.html(progress + '%');
      },
      fail: function (e, data) 
      {
        window.onbeforeunload = null;
        $('.progress[data-mod="'+data.files[0].size+'"] .progress-bar').css('width', '100%').addClass('red').html('');
      },
      done: function (event, data) 
      {
        window.onbeforeunload = null;
        // Upload Complete, show information about the upload in a textarea
        // from here you can do what you want as the file is on S3
        // e.g. save reference to your server / log it, etc.
        //console.log( JSON.stringify( data, null, 2 ) );
        $progressContainer.hide();
        $progress.css('width', '0%');
        $progress.html('0%');
        var original = data.files[0];
        var s3Result = data.result.documentElement.children;
        var reader = new FileReader();
        reader.readAsDataURL(data.files[0]);
        reader.onload = function(_file) 
        {
          var image  = new Image();
          image.src    = _file.target.result;              // url.createObjectURL(file);
          image.onload = function() 
          {
            var w = this.width;
            var h = this.height;
            var img = document.createElement("img");
            img.src = s3Result[0].innerHTML;
            var square = ( w == h ) ? 1 : 0;
            filesUploaded.push({
              "original_name": original.name,
              "s3_name": s3Result[2].innerHTML,
              "size": original.size,
              "url": s3Result[0].innerHTML,
              "width": w,
              "height": h,
              "is_square": square,
              "type": 'local'
            });
            $.ajax({
              url: urlSuccess,
              data: { files: filesUploaded }
            }).done(function(data) 
            {
              var image = {
                url: s3Result[0].innerHTML,
                is_square: square,
                width: w,
                height: h,
                id: s3Result[2].innerHTML,
                type: 'local'
              };
              $('#local-photos').tmpl(image).appendTo('#files');
            });
          }
        };
      }
    });
  },
  startSpectrum: function($) 
  {
    if ($.fn.spectrum) 
    {
      $("#border").spectrum({
        showPalette: true,
        showPaletteOnly: true,
        chooseText: "Alright",
        cancelText: "No way",
        preferredFormat: "hex",
        palette: [
          BORDER_COLORS
        ]
      });
    }
  },
  launchEditor: function(id, src) {
    featherEditor.launch({
      image: id,
      url: src,
      //forceCropPreset: ['Square','640x640'],
      //forceCropMessage: 'Please crop your photo to this size'
      //resize: true,
      //displayImageSize: true
      cropPresets: ['640x640']
    });
    return false;
  },
  addImageToSet: function($)
  {
    $(document).on('click', '.add-image-to-set', function()
    {
      var elem = $(".add_to_set[data-has-image='']:first");
      var url = $(this).parent().parent().parent().parent().attr('data-url');
      var id = $(this).parent().parent().parent().parent().attr('data-id');
      var square = $(this).parent().parent().parent().parent().attr('data-is-square');
      var w = $(this).parent().parent().parent().parent().attr('data-width');
      var h = $(this).parent().parent().parent().parent().attr('data-height');
      var elemNo = $(elem).attr('data-i');
      $('#editable-'+elemNo).attr('src', url);
      elem.attr('data-has-image', true);
      elem.attr('data-url', url);
      elem.attr('style', 'background-image: url('+url+');');
      elem.find('.square-content').addClass('hidden');
      elem.find('.btn').css('display', 'block');
      elem.attr('data-is-square', square);
      elem.attr('data-width', w);
      elem.attr('data-height', h);
      elem.attr('data-big-id', id);
      productScript.initAddToCartButton();
    });
  },
  removePhotoFromSet: function($)
  {
    $(document).on('click', '.remove-set-image', function() 
    {
      var idx = $(this).attr('data-idx');
      $(this).parent().parent().parent().parent().attr('style', '');
      $(this).parent().parent().parent().parent().attr('data-url', '');
      $(this).parent().parent().parent().parent().attr('data-has-image', '');
      $(this).parent().parent().parent().parent().attr('data-is-square', '');
      $(this).parent().parent().parent().parent().attr('data-width', '');
      $(this).parent().parent().parent().parent().attr('data-height', '');
      $(this).parent().parent().parent().parent().attr('data-big-id', '');
      $(this).parent().find('span.edit-set-image').hide();
      $(this).parent().find('span.remove-set-image').hide();
      $('#editable-'+idx).attr('src', '');
      productScript.initAddToCartButton();
    });
  },
  editPhotoFromSet: function($)
  {
    $(document).on('click', '.edit-set-image', function() 
    {
      var idx = $(this).attr('data-idx');
      var url = $('#idx-'+idx).attr('data-url');
      return productScript.launchEditor("editable-"+idx, url);
    });
  },
  initAddToCartButton: function() {
    var elemWithImage = jQuery(".add_to_set[data-has-image!='']").length;
    var elemIsSquare = jQuery(".add_to_set[data-is-square='1']").length;
    if( ELEMENTS == elemWithImage && ELEMENTS == elemIsSquare )
    {
      jQuery('#btn-add-to-cart').removeClass('hidden');
    }
    else
    {
      jQuery('#btn-add-to-cart').addClass('hidden');
    }
  },
  initAddToCart: function($) {
    $(document).on('click', '#btn-add-to-cart', function(e){
      //RECAPTCHA
      /*var response = grecaptcha.getResponse();
      //recaptcha failed validation
      if(response.length == 0) 
      {
        e.preventDefault();
        //$('#recaptcha-error').show();
        $('.alert-add-to-basket').remove();
        $('#btn-add-to-cart').prepend('<div class="alert alert-warning alert-add-to-basket">'+CAPTCHA_ERROR+'</div>');
        return true;
      }*/
      $.blockUI({ message: '<h3><i class="fa fa-cog fa-spin fa-3x fa-fw"></i> <br/> '+ADDING_TO_BASKET_TEXT+'</h3>' });
      $('.alert-add-to-basket').hide();
      var basketData = new Array();
      $('.add_to_set').each(function(index)
      {
        basketData[index] = $(this).attr('data-url');
      });
      $.ajax({
        type: "POST",
        url: URL_CART_ADD,
        dataType: 'json',
        data: {
          pictures: basketData,
          group: $(this).attr("data-group"),
          product_type: $(this).attr("data-type"),
          product_price: $(this).attr("data-price"),
          border: $('#border').val()
        },
        beforeSend: function(result) {},
        success: function(result) 
        {
          if(result.status == 'success') 
          {
            window.location.assign(URL_CART);
          } 
          else 
          {
            //TODO show error alert
          }
        }
      });
    });
  },
  init: function($) {
    productScript.initGridSquares($);
    productScript.initTabs($);
    productScript.initAwsUpload($);
    productScript.startSpectrum($);
    productScript.addImageToSet($);
    productScript.removePhotoFromSet($);
    productScript.editPhotoFromSet($);
    productScript.initAddToCart($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  productScript.init($);
});