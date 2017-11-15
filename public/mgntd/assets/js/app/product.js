var productScript = {
  initGridSquares: function($) {
    $('body').on('mouseover', '.add_to_set', function(){
      $( this ).find(".square-content").removeClass('hidden');
    });
    $('body').on('mouseout', '.add_to_set', function(){
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
    //var urlSuccess = LOCALE+'/product/s3';
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
        //var acceptFileTypes = /^image\/(png)$/i;
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
        // Remove the 'unsaved changes' message.
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
        var image  = new Image();
        reader.readAsDataURL(data.files[0]);
        reader.onload = function(_file) 
        {
          image.src    = _file.target.result;              // url.createObjectURL(file);
          image.onload = function() 
          {
            var w = this.width,
            h = this.height;
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
  initAviary: function() {
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
        $.ajax({
            method: "POST",
            dataType: "json",
            url: LOCALE+"product/updatephoto",
            data: {
                new_url: newURL,
                url: jQuery('#'+imageID).attr("src")
            }
        })
        .done(function( data ) {
          var setId = imageID.replace('image-idx-','idx-');
          var uploadedPhoto2 = $("#"+setId);
          if( data.new_size.width == data.new_size.height )
          {
              uploadedPhoto2.parent('.addset').attr('data-is-square', '1');
              uploadedPhoto2.parent('.addset').parent('.thumbnail').attr('data-is-square', '1');
          }
          uploadedPhoto2.parent('.addset').attr('data-width', data.new_size.width);
          uploadedPhoto2.parent('.addset').attr('data-height', data.new_size.height);
          //refresh image src
          var style = uploadedPhoto2.attr('style');
          //uploadedPhoto2.removeAttr("style").attr("style", 'background-image:url("'+newURL+'")');
          uploadedPhoto2.parent('.addset').attr('data-url', newURL);
          uploadedPhoto2.attr('src', newURL);
          uploadedPhoto2.parent('.add_to_set').find('span.btn.edit-set-image').attr('onclick', "return launchEditor("+setId+", '"+newURL+"');");
          // Remove focus from link
          $(".thumbnail").blur();
          // Close Aviary editor popup
          featherEditor.close();
        });
      }
    });
    function launchEditor(id, src) {
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
    }
  },
  init: function($) {
    productScript.initGridSquares($);
    productScript.initTabs($);
    productScript.initAwsUpload($);
  }
};
jQuery(document).ready(function($) {
  "use strict";
  productScript.init($);
});