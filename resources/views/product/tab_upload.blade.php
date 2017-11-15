<form enctype="{{ $formAttributes['enctype'] }}" method="{{ $formAttributes['method'] }}" action="{{ $formAttributes['action'] }}" class="awsUploadForm">
  <input id="fileupload" type="file" name="file" multiple>
  <div class="progress" id="progress" style="display: none;">
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
      0%
    </div>
  </div>
  <div>
  @foreach( $formInputs as $name => $value )
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
  @endforeach
  </div>
</form>

<script id="local-photos" type="text/x-jquery-tmpl">
<div class="square-9 files-element">  
  <img src="${url}" alt="" style="" class="img img-responsive full-width" data-is-square="${is_square}" data-width="${width}" data-height="${height}" data-id="${id}" data-url="${url}" data-type="${type}">
  <a href="javascript:void(0)" class="add-image-to-set">
    <i class="fa fa-plus"></i> Dodaj do zestawu
  </a>
</div>
</script>

<div id="files">
@if( count($uploaded_files) > 0 )
  @foreach( $uploaded_files as $key => $t )
  <div class="square-9 files-element">  
    <img src="{{ $t['url'] }}" alt="" style="" class="img img-responsive full-width" data-is-square="{{ $t['is_square'] }}" data-width="{{ $t['width'] }}" data-height="{{ $t['height'] }}" data-id="{{ $key }}" data-url="{{ $t['url'] }}" data-type="{{ $t['type'] }}">
    <a href="javascript:void(0)" class="add-image-to-set">
      <i class="fa fa-plus"></i> {{ __('products.add_to_set') }}
    </a>
  </div>
  @endforeach
@endif
</div>