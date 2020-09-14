@extends('layouts.layout')

@section('css')
<link href="{{asset('assets/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
  <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <x-breadcrumb type="list" />  
    @if(isset($data['setting']['action_buttons']) && count($data['setting']['action_buttons']) > 0)
      <x-action-button :setting="$data['setting']['action_buttons']"/>
    @endif
  </div>
  <x-table :model="$data['model']" :setting="$data['setting']['table']"/>
</div>

@endsection
