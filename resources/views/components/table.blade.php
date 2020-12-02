@section('css_component')
<link rel="stylesheet" href="{{ asset('assets/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/lib/datatables.net/css/buttons.dataTables.min.css')}}">
@endsection
<div data-label="Example" class="df-example demo-table">
	@if(count($filters) > 0 )
	<div class="collapse m-b-10" id="advance-filter-form">
		<div class="row">
			<div class="col-md-12 m-b-5">
				<label><h6>Advance Filter</h6></label>
			</div>
			@foreach($filters as $f)
			<div class="col-md-3">
				<div class="form-group">
					@if(in_array(trim($f['type']), ['text','email','number']))
					<input name="{{$f['name']}}" type="{{$f['type']}}" class="form-control input-filter" placeholder="{{\Str::title($f['name'])}}">
					@endif
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@endif
	@if(count($setting['bulks']) > 0)
	<div class="row mg-b-5 no-gutters">
		<div class="col-md-2 offset-md-9">
			<select name="action_bulk" class="form-control float-right">
				<option value=""></option>
				@foreach($setting['bulks'] as $k=>$v)
				<option value="{{$k}}">{{$v}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-1">
			<button class="btn btn-secondary btn-bulk-actions">Submit</button>
		</div>
	</div>
	@endif
	<table id="table-{{Str::random(10)}}" class="table datatable table-striped table-hover" 
		data-searchable="{{count($filters)}}" 
		data-source="{{url($setting['source'])}}"
		data-columns="{{$columns}}">
	  <thead>
	    <tr>
	    	@if(count($setting['bulks']) > 0)
	    		<th>
	    			<input type="checkbox" name="all" id="table-checkall" class="">
	    		</th>
	    		<!-- <th></th> -->
	    	@endif
	    	@foreach($setting['columns'] as $s)
	    		@if($s['visible'] == true)
	        	<th>{{Str::replaceArray('_',[' '],$s['title'])}}</th>
	        	@endif
	        @endforeach

	        @if(isset($setting['grid_actions']))
	        <th>Actions</th>
	        @endif
	    </tr>
	  </thead>
	</table>
</div><!-- df-example -->

@section('js_component')
<script src="{{asset('assets/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net/js/buttons.colVis.min.js')}}"></script>

@endsection