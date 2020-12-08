<div class="d-md-block">
  @foreach($data as $s)
	@php $attr = isset($s['attributes'])?$s['attributes']:'' @endphp
  	@if(isset($s['type']))
	  	@if($s['type'] == 'link')
		<a class="btn btn-sm pd-x-15 {{$s['class']}} btn-uppercase mg-l-5" href="{{$s['url']}}" {{ $attr }}>
			@if(isset($s['icon']) && $s['icon'] != '')
	  		<i data-feather="{{$s['icon']}}" class="wd-10 mg-r-5"></i>
	  		@endif
	  		{{$s['title']}}
	  	</a>
  		@elseif($s['type'] == 'button')
  		<button class="btn btn-sm pd-x-15 {{$s['class']}} btn-uppercase mg-l-5" {{ $attr }}>
  			@if(isset($s['icon']) && $s['icon'] != '')
	  		<i data-feather="{{$s['icon']}}" class="wd-10 mg-r-5"></i>
	  		@endif
	  		{{$s['title']}}
		</button>
		@else
		<div></div>
		@endif
	@endif
  @endforeach
</div>
