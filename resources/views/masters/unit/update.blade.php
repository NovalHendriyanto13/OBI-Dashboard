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
                Mobilisasi
            </div>
          </div>
          <div class="tab-pane fade show" id="gallery" role="tabpanel" aria-labelledby="gallery">
            <div class="row row-sm mg-b-10">
                <x-input-hidden :attr="[
                  'name'=>'unit_id',
                  'value'=>$id,
                ]"/>
                <x-input-text :attr="[
                  'name'=>'gallery-name',
                  'id'=>'gallery-name',
                  'label'=>'Gallery Name',
                  'class'=>'gallery-name']"/>

                <x-input-checkbox :attr="[
                  'name'=>'name',
                  'label'=>'Same as Code',
                  'class'=>'same', 
                  'options'=>['true']]"/>

                <x-input-text :attr="[
                  'name'=>'gallery_item',
                  'type'=>'file']" />

                <div class="col-sm-6">
                  <div class="form-group mg-b-20">
                    <label>&nbsp;</label>
                  <x-action-button :setting="[[
                    'icon'=>'check-circle',
                    'class'=>'btn-success btn-upload',
                    'title'=>'Upload',
                    'type'=>'button']]"/>
                  </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="row">
                    @foreach($galleries as $image)
                    <div class="col-md-3 col-sm-4">
                      <img src="{{asset('images/'.$image)}}" class="img-responsive"/>
                    </div>
                    @endforeach
                  </div>
                </div>
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

@section('js')
<script type="text/javascript">
  $('.same').change(function(e){
    let that = $(this)
    let galleryName = $('#gallery-name')
    if (this.checked) {
      let unitCode = $('#unit_code').val()
      galleryName.val(unitCode)
      return true
    }
    galleryName.val('')
    return false
  })

  $('.btn-upload').click(function(e){
    e.preventDefault()
    var that = $(this)
    var url = 'gallery/create'
    var method = 'POST'
    var params = new FormData()

    params.append('name', $('#gallery-name').val())
    params.append('image',$('#gallery_item')[0].files[0])
    params.append('tablename','unit')
    params.append('table_id',$('#unit_id').val())

    const alert = $('.alert')
    const alertForm = $('.alert-form')
    const alertMsg = $('.alert-msg')
    if (typeof(method) === 'undefined') {
      alertMsg.html('Error ! Please provide form method')
      alertForm.css('display','block')
      return false;
    }

    $.ajax({
      url: baseUrl + url,
      data: params,
      type: method,
      dataType: 'JSON',
      // cache:false,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: ()=>{
        $('.spinner').css('display','block')
      },
      complete: ()=> {
        $('.spinner').css('display','none')
      },
      success: (res)=> {

        let data = res.data
        if(res.status === true) {
          if (typeof(res.redirect.page) != 'undefined') {
            return window.location.href = baseUrl + res.redirect.page
          }
        }
        else {
          console.log(res.errors.messages)
          if (typeof(res.errors.messages) === 'object') {
            let errId
            $.each((res.errors.messages), function(i, v) {
              if (i == 'name')
                i = 'gallery-name'
              else if(i == 'image')
                i = 'gallery_item'

              console.log(i)

              errId = $('#'+i+'-errors')
              var errMessage = ''
              $.each(v, function(ix, error) {
                errMessage = errMessage + error + '<br/>'
              })
              errId.html(errMessage)
              errId.css('display','block')
            })
            alertMsg.html('Error ! Some errors in your input')
          }
          else {
            alertMsg.html('Error ! ' + res.errors.messages)
          }
          alertForm.css('display','block')
        }
      },
      error: (err)=> {
        console.log(err)
        console.log('error-request')
        alertMsg.html('Error ! Something error in your input')
        alertForm.css('display','block')
      }
    });
  })
</script>
@endsection
