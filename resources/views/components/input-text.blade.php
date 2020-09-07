<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::ucfirst($attributes['label']) : \Str::ucfirst($attributes['name'])}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
		<input type="{{isset($attributes['type']) ? $attributes['type'] : 'text'}}" 
			class="form-control" 
			placeholder="{{isset($attributes['label']) ? \Str::ucfirst($attributes['label']) : \Str::ucfirst($attributes['name'])}}" 
			name="{{$attributes['name']}}"
			value="{{isset($attributes['value']) ? $attributes['value'] : ''}}">
	</div>
	<!-- <div class="valid-feedback">Looks good!</div> -->
</div>