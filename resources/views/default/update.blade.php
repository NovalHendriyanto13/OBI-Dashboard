@extends('layouts.layout')

@section('content')
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
  <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
          <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{URL::to(variable_get('base_url'))}}">{{variable_get('title')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
      </nav>
      <h4 class="mg-b-0 tx-spacing--1">{{variable_get('title')}} Update</h4>
    </div>    
  </div>
  
  <div class="row row-xs">
    <div class="col-md-12 col-xs-12">
      <x-form :id="variable_get('base_url')" :action="variable_get('base_url').'/update'" class="form" method="put" />
    </div>
  </div>
</div>
@endsection
