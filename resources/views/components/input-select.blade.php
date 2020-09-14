<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
	    <select class="form-control select2" name="{{$attributes['name']}}" id="{{$attributes['name']}}">
	    	@if($attributes['allowEmpty'])
	    	<option value=""> Select One </option>
	    	@endif
	      @foreach($attributes['options'] as $k=>$v)

	      <option 
	      	value="{{ $k }}" 
	      	@if(isset($attributes['value']) && $attributes['value'] == $k) selected="true" @endif>{{ $v }}</option>
	      @endforeach
	      
	    </select>
	</div>
</div>