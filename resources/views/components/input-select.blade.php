<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::ucfirst($attributes['label']) : \Str::ucfirst($attributes['name'])}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
	    <select class="form-control select2">
	    	@if($attributes['allowEmpty'])
	    	<option value=""> Select One </option>
	    	@endif
	      @foreach($attributes['options'] as $k=>$v)
	      <option value="{{ $k }}">{{ $v }}</option>
	      @endforeach
	      
	    </select>
	</div>
</div>