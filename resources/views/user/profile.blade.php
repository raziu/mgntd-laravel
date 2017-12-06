@extends('layouts.app')

@section('pageTitle', __('profile.meta_title') )
@section('pageDesc', __('profile.meta_description') )

@section('styles')

@parent    
@stop

@section('javascript')
<script type="text/javascript">
  var LANG = '{{ app()->getLocale() }}';
</script>
<script type="text/javascript" src="{{ URL::asset(config('app.theme').'/assets/js/app/profile.js') }}"></script>
@parent    
@stop

@section('content')
@include('partials.title',['pageTitle' => __('profile.meta_title')])

<section class="module profile">
  <div class="container">
  @php
  //echo "<pre>".print_r( $user, 1 )."</pre>";
  /*[id] => 1
    [name] => Tommy Ra
    [email] => raziu@
    [password] => 
    [remember_token] => 
    [created_at] => 2017-12-01 20:16:53
    [updated_at] => 2017-12-01 20:16:53*/
  @endphp
  <div class="row">
    <div class="col-md-5 card">
      <div class="card-header">
        <h3 class="text-left">{{ __('profile.welcome') }} {{ $user->name }}</h3>
      </div>
      <div class="card-description">
        <form action="" method="post">
        <div class="form-group">
          <label for="fullname">{{ __('basket.label_fullname') }}</label>
          <input type="text" id="fullname" name="fullname" class="form-control" placeholder="{{ __('basket.placeholder_fullname') }}" value="{{ $user->name }}">
        </div>
        <div class="form-group">
          <label for="email">{{ __('basket.label_email') }}</label>
          <input type="text" id="email" name="email" class="form-control" placeholder="{{ __('basket.placeholder_email') }}" value="{{ $user->email }}">
        </div>
        <input type="submit" name="save" class="btn btn-primary" value="{{ __('profile.btn_save') }}"/>
        </form>
      </div>
      <div class="card-footer">
        <div>
          <label>{{ __('profile.created') }} </label>
          {{ $user->created_at }}
        </div>
        <div>
          <label>{{ __('profile.updated') }} </label>
          {{ $user->updated_at }}
        </div>
      </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6 card">
      <div class="card-header">
        <h3 class="text-left">{{ __('profile.saved_addresses') }}</h3>
      </div>
      <div class="card-description">
      @if( count( $addresses ) )
        @foreach( $addresses as $addr )
        <h4>{{ $addr->address_name }}</h4>
        <span class="pull-left">
          {{ $addr->fullname }}, {{ $addr->address }}, {{ $addr->zip }} {{ $addr->city }}, {{ $addr->country }}
        </span>
        <span class="pull-right">
          <a href="{{ route('profile_address_edit', [$addr->id]) }}">{{ __('profile.link_edit') }}</a>
        </span>
        @endforeach
      @else
        <p>{{ __('profile.no_saved_addresses') }}</p>
      @endif
      </div>
      
      
    </div>
  </div>
  </div>
</section>  
@endsection 