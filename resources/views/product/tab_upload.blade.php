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
<div class="square-5 files-element photo_to_add" style="background-image: url('${url}');'"  data-is-square="${is_square}" data-width="${width}" data-height="${height}" data-id="${id}" data-url="${url}" data-type="${type}">  
  <div class="square-content hidden">
    <div class="table">
      <div class="table-cell">
        <a href="javascript:void(0)" class="btn btn-default add-image-to-set" title="{{ __('products.add_to_set') }}">
          <i class="fa fa-plus"></i>
        </a>
      </div>
    </div>
  </div>
</div>
</script>

<div id="files">
@if( count($uploaded_files) > 0 )
  @foreach( $uploaded_files as $key => $t )
  <div class="square-5 files-element photo_to_add" style="background-image: url('{{ $t['url'] }}');'"  data-is-square="{{ $t['is_square'] }}" data-width="{{ $t['width'] }}" data-height="{{ $t['height'] }}" data-id="{{ $key }}" data-url="{{ $t['url'] }}" data-type="{{ $t['type'] }}">  
    <div class="square-content hidden">
      <div class="table">
        <div class="table-cell">
          <a href="javascript:void(0)" class="btn btn-default add-image-to-set" title="{{ __('products.add_to_set') }}">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endif
</div>