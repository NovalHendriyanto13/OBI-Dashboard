@extends('layouts.layout')

@section('css')

@endsection

@section('content')
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
  <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <x-breadcrumb type="update" />  
  </div>
  
  <div class="row row-xs">
    <div class="col-md-12 col-xs-12">
      <x-form :id="variable_get('base_url')" :action="variable_get('base_url').'/update/'.$id" class="form" method="post">
        <x-slot name="additionalTabTitle">
            <li class="nav-item">
              <a class="nav-link" id="mobilisasi-tab" data-toggle="tab" href="#mobilisasi" role="tab" aria-controls="home" aria-selected="true">Mobilisasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="home" aria-selected="true">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="auction-tab" data-toggle="tab" href="#auction" role="tab" aria-controls="home" aria-selected="true">Auction History</a>
            </li>
        </x-slot>
        <x-slot name="additionalTab">
          <div class="tab-pane fade show" id="mobilisasi" role="tabpanel" aria-labelledby="mobilisasi">
            <div class="row row-sm mg-b-10">
              <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                  @if(isset($mobilization['setting']['action_buttons']) && count($mobilization['setting']['action_buttons']) > 0)
                    <x-action-button :setting="$mobilization['setting']['action_buttons']"/>
                  @endif
                </div>
                <x-table :model="$mobilization['model']" :setting="$mobilization['setting']['table']" style="width:100% !important"/>
              </div>
            </div>
          </div>
          <div class="tab-pane fade show" id="gallery" role="tabpanel" aria-labelledby="gallery">
            <div class="row row-sm mg-b-10">
                <x-gallery tablename="unit" :table-id="$id" allow-duplicate="true" />
            </div>
          </div>
          <div class="tab-pane fade show" id="auction" role="tabpanel" aria-labelledby="auction">
            <div class="row row-sm mg-b-10">
                Auction
            </div>
          </div>
        </x-slot>
      </x-form>
    </div>
  </div>
</div>
@endsection
