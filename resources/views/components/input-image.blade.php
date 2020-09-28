<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>
		<div class="col-md-12 mb-2">
            <img id="{{\Str::lower($attributes['name'])}}-preview"
                alt="preview image" style="max-height: 150px;display: none">
        </div>
		<input type="file" 
			class="form-control input-image {{isset($attributes['class']) ? $attributes['class'] : ''}}" 
			name="{{$attributes['name']}}"
			value="{{isset($attributes['value']) ? $attributes['value'] : ''}}"
			id="{{\Str::lower($attributes['name'])}}"
		/>

		<x-alert class="alert-element mg-t-5" id="{{$attributes['name']}}-errors"></x-alert>
	</div>
	<!-- <div class="valid-feedback">Looks good!</div> -->
</div>