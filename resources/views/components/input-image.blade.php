<div class="col-sm-6">
	<div class="form-group mg-b-20">
		<label>
		{{isset($attributes['label']) ? \Str::title($attributes['label']) : \Str::title(\Str::of($attributes['name'])->replace('_',' '))}}
		@if(isset($attributes['required']) &&  $attributes['required'] == true) 
		<span class="tx-danger">*</span>
		@endif
		</label>

		<div class="col-md-12 mb-2">
			<div class="container-image" style="position: relative;">
	            <img id="{{\Str::lower($attributes['name'])}}-preview"
	                alt="preview image" 
	                class="preview-image @if(isset($attributes['value'])) view-image @endif"
	                style="max-height: 150px; @if(!isset($attributes['value'])) display: none; @endif" 
	                @if(isset($attributes['value'])) src="{{ image_url($attributes['value']) }}" @endif>
	            <a class="remove-preview" 
	            	id="{{\Str::lower($attributes['name'])}}-preview-remove"
	            	href="#" 
	            	data-target="{{\Str::lower($attributes['name'])}}-preview"
	            	data-file="{{\Str::lower($attributes['name'])}}"
	            	style="max-height: 150px;color: red; @if(!isset($attributes['value'])) display: none; @endif" >Remove</a>
	        </div>
        </div>
		<input type="file" 
			class="form-control input-image {{isset($attributes['class']) ? $attributes['class'] : ''}}" 
			name="{{$attributes['name']}}"
			value="{{isset($attributes['value']) ? $attributes['value'] : ''}}"
			id="{{\Str::lower($attributes['name'])}}"
		/>
		<!-- <input name="{{$attributes['name']}}" type="hidden" value="{{isset($attributes['value']) ? $attributes['value'] : ''}}"> -->

		<x-alert class="alert-element mg-t-5" id="{{$attributes['name']}}-errors"></x-alert>
	</div>
	<!-- <div class="valid-feedback">Looks good!</div> -->
</div>