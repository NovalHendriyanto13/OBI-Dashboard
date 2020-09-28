<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
	    <select class="form-control select2 @if(isset($attributes['class'])) {{$attributes['class']}} @endif" 
	    	name="{{$attributes['name']}}" 
	    	id="{{\Str::lower($attributes['name'])}}" 	    	
	    	@if(isset($attributes['ajax-href'])) ajax-to="{{$attributes['ajax-href']}}" @endif
	    	@if(isset($attributes['ajax-to'])) ajax-to="{{$attributes['ajax-to']}}" @endif>

			@if($attributes['allowEmpty'])
			<option value=""> Select One </option>
			@endif
			@foreach($attributes['options'] as $k=>$v)

			<option 
				value="{{ $k }}" 
				@if(isset($attributes['value']) && $attributes['value'] == $k) selected="true" @endif>{{ $v }}</option>
			@endforeach
	      
	    </select>

	    <x-alert class="alert-element mg-t-5" id="{{$attributes['name']}}-errors"></x-alert>
	</div>
</div>