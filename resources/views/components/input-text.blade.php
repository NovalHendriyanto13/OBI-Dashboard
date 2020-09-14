<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
		<input type="{{isset($attributes['type']) ? $attributes['type'] : 'text'}}" 
			class="form-control" 
			placeholder="{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}" 
			name="{{$attributes['name']}}"
			value="{{isset($attributes['value']) ? $attributes['value'] : ''}}"
			@if($attributes['readonly'] == true) readonly @endif>
	</div>
	<!-- <div class="valid-feedback">Looks good!</div> -->
</div>