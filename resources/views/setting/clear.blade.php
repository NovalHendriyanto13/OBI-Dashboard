@extends('layouts.layout')

@section('css')
<link href="{{asset('assets/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
  <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <x-breadcrumb type="clear" />  
    <x-action-button :setting="$action_buttons"/>
  </div>
  <div data-label="Example" class="df-example demo-table">
    <table id="table-{{Str::random(10)}}" class="table datatable">
      <thead>
        <tr>
            <th class="wd-10p">Setting Name</th>  
            <th class="wd-10p">Action</th>         
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="wd-10p">Clear Cache Current User</td>  
          <td class="wd-10p"></td>  
        </tr>
        <tr>
          <tr>
          <td class="wd-10p">Clear Cache</td>  
          <td class="wd-10p"></td>  
        </tr>
        </tr>    
      </tbody>
    </table>
  </div><!-- df-example -->
</div>

@endsection