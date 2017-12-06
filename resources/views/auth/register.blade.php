@extends('layouts.app')

@section('pageTitle', __('auth.meta_title_register') )
@section('pageDesc', __('auth.meta_description_register') )

@section('content')
<section class="page-header-module module bg-dark" data-background="/img/header.jpg">
@include('partials.title',['pageTitle' => __('auth.meta_title_register')])
<section class="module">
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">{{ __('auth.meta_title_register') }}</div>
                  <div class="panel-body">
                      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="col-md-4 control-label">{{ __('auth.register_form_label_name') }}</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-md-4 control-label">{{ __('auth.register_form_label_email') }}</label>
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="col-md-4 control-label">{{ __('auth.register_form_label_password') }}</label>
                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="password-confirm" class="col-md-4 control-label">{{ __('auth.register_form_label_password_repeat') }}</label>
                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary">
                                  {{ __('auth.register_form_label_btn') }}
                                  </button>
                              </div>
                          </div>
                          <hr/>
                          <div class="form-group">
                          <div class="col-md-8 col-md-offset-4">
                            <a href="{{route('instagram_redirect')}}" class="btn btn-social" title="{{ __('auth.login_form_label_instagram') }}">
                              <img src="/img/ico/instagram-logo.svg" alt="" style="height:40px;" />
                            </a>
                            {{ __('global.or') }}
                            <a href="{{route('facebook_redirect')}}" class="btn btn-social" title="{{ __('auth.login_form_label_facebook') }}">
                              <img src="/img/ico/facebook-logo.svg" alt="" style="height:40px;" />
                            </a>
                          </div>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
