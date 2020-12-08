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
              <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home" aria-selected="true">Details</a>
            </li>
        </x-slot>
        <x-slot name="additionalTab">
          <div class="tab-pane fade show" id="detail" role="tabpanel" aria-labelledby="detail">
            <div class="row row-sm mg-b-10">
              <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                  @if(isset($details['setting']['action_buttons']) && count($details['setting']['action_buttons']) > 0)
                    <x-action-button :setting="$details['setting']['action_buttons']"/>
                  @endif
                </div>
                <x-table :setting="$details['setting']['table']" style="width:100% !important"/>
              </div>
            </div>
          </div>
        </x-slot>
      </x-form>
    </div>
  </div>
</div>

@include('auction.auction._units')

@endsection

@section('js')
<script type="text/javascript">
$('.btn-add-unit').click(function(e) {
  e.preventDefault()
  const auctionId = $(this).data('aid')
  $.ajax({
    url: baseUrl + 'auction-detail/populate/' + auctionId,
    type: 'GET',
    dataType:'json',
    success: function(res) {
      console.log(res)
    } 
  })
  $('#unit-modal').modal('show')
})
</script>
@endsection
