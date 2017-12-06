@extends('layouts.app')

@section('pageTitle', __('info.meta_title') )
@section('pageDesc', __('info.meta_description') )

@section('content')
@include('partials.title',['pageTitle' => __('info.meta_title_privacy')])

@endsection 