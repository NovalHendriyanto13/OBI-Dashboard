<div data-label="Example" class="df-example demo-table">
	<table id="table-{{Str::random(10)}}" class="table datatable">
	  <thead>
	    <tr>
	    	@if(isset($setting['actions']))
	    		<th class="wd-3p">
	    			<input type="checkbox" name="all" id="table-checkall" class="custom-control-input">
	    		</th>
	    	@endif
	    	@foreach($setting['columns'] as $s)
	    		@if($s['visible'] == true)
	        	<th class="wd-10p">{{Str::replaceArray('_',[' '],$s['title'])}}</th>
	        	@endif
	        @endforeach

	        @if(isset($setting['grid_actions']))
	        <th class="wd-10p">Actions</th>
	        @endif
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($data as $d)
	  	<tr>
	  		@if(isset($setting['actions']))
	    		<td>
	    			<input type="checkbox" name="check[]" id="table-check" value="{{$d->id}}" class="custom-control-input">
	    		</td>
	    	@endif
	  		@foreach($setting['columns'] as $s)
	    		@if($s['visible'] == true)
	    		@php $k = $s['name'] @endphp
	        	<td>{{$d->$k}}</td>
	        	@endif
	        @endforeach

	        @if(isset($setting['grid_actions']))
	        <td>
	        	@foreach($setting['grid_actions'] as $action)
	        	<a href="{{$action['url']}}/{{$d->id}}" class="btn {{$action['class']}}">
	        		@if(isset($action['icon']) && $action['icon'] != '')
			  		<i data-feather="{{$action['icon']}}" class="wd-10 mg-r-5"></i>
			  		@endif
	        		{{$action['title']}}
	        	</a> &nbsp;
	        	@endforeach
	        </td>
	        @endif		    
        </tr>
        @endforeach
	  </tbody>
	</table>
</div><!-- df-example -->

@section('js')
<script src="{{asset('assets/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script>
@endsection