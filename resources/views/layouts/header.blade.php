 <header class="navbar navbar-header navbar-header-fixed">
  <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
  <div class="navbar-brand">
    <a href="{{url('/')}}" class="df-logo">OTOBID<span>Indonesia</span></a>
  </div><!-- navbar-brand -->
  <div id="navbarMenu" class="navbar-menu-wrapper">
    <div class="navbar-menu-header">
      <a href="{{url('/')}}" class="df-logo">OTOBID<span>Indonesia</span></a>
      <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
    </div><!-- navbar-menu-header -->
    <ul class="nav navbar-menu">
      <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
      @foreach(set_menu(Auth::user()->group_id) as $parent=>$menus)
      <li class="nav-item with-sub active">
        <a href="" class="nav-link"><i data-feather="pie-chart"></i> {{$parent}}</a>
        @if (count((array) $menus) > 0)
        <ul class="navbar-menu-sub">
          @foreach($menus as $group=>$menu)
            @if($group != '')
            <li class="nav-label">{{$group}}</li>
            @endif
            @foreach($menu as $item)
            <li class="nav-sub-item"><a href="{{route($item->initial)}}" class="nav-sub-link">@if($item->icon != '') <i data-feather="bar-chart-2"></i> @endif {{$item->name}}</a></li>
            @endforeach
          @endforeach
        </ul>
        @endif
      </li>
      @endforeach
      <li class="nav-item with-sub">
        <a href="" class="nav-link"><i data-feather="layers"></i> Pages</a>
        <div class="navbar-menu-sub">
          <div class="d-lg-flex">
            <ul>
              <li class="nav-label">Authentication</li>
              <li class="nav-sub-item"><a href="{{URL::to('group')}}" class="nav-sub-link"><i data-feather="log-in"></i> Group</a></li>
              <li class="nav-sub-item"><a href="{{URL::to('user')}}" class="nav-sub-link"><i data-feather="user-plus"></i> Users</a></li>
              <li class="nav-sub-item"><a href="{{URL::to('module')}}" class="nav-sub-link"><i data-feather="user-check"></i> Module</a></li>
              <li class="nav-sub-item"><a href="{{URL::to('menu')}}" class="nav-sub-link"><i data-feather="shield-off"></i> Menu </a></li>
              <li class="nav-label mg-t-20">User Pages</li>
              <li class="nav-sub-item"><a href="page-profile-view.html" class="nav-sub-link"><i data-feather="user"></i> View Profile</a></li>
              <li class="nav-sub-item"><a href="page-connections.html" class="nav-sub-link"><i data-feather="users"></i> Connections</a></li>
              <li class="nav-sub-item"><a href="page-groups.html" class="nav-sub-link"><i data-feather="users"></i> Groups</a></li>
              <li class="nav-sub-item"><a href="page-events.html" class="nav-sub-link"><i data-feather="calendar"></i> Events</a></li>
            </ul>
            <ul>
              <li class="nav-label">Error Pages</li>
              <li class="nav-sub-item"><a href="page-404.html" class="nav-sub-link"><i data-feather="file"></i> 404 Page Not Found</a></li>
              <li class="nav-sub-item"><a href="page-500.html" class="nav-sub-link"><i data-feather="file"></i> 500 Internal Server</a></li>
              <li class="nav-sub-item"><a href="page-503.html" class="nav-sub-link"><i data-feather="file"></i> 503 Service Unavailable</a></li>
              <li class="nav-sub-item"><a href="page-505.html" class="nav-sub-link"><i data-feather="file"></i> 505 Forbidden</a></li>
              <li class="nav-label mg-t-20">Other Pages</li>
              <li class="nav-sub-item"><a href="page-timeline.html" class="nav-sub-link"><i data-feather="file-text"></i> Timeline</a></li>
              <li class="nav-sub-item"><a href="page-pricing.html" class="nav-sub-link"><i data-feather="file-text"></i> Pricing</a></li>
              <li class="nav-sub-item"><a href="page-help-center.html" class="nav-sub-link"><i data-feather="file-text"></i> Help Center</a></li>
              <li class="nav-sub-item"><a href="page-invoice.html" class="nav-sub-link"><i data-feather="file-text"></i> Invoice</a></li>
            </ul>
          </div>
        </div><!-- nav-sub -->
      </li>
      
      <!---- END -->
      <li class="nav-item"><a href="../../components/" class="nav-link"><i data-feather="box"></i> Components</a></li>
      <li class="nav-item"><a href="../../collections/" class="nav-link"><i data-feather="archive"></i> Collections</a></li>
    </ul>
  </div><!-- navbar-menu-wrapper -->
  <div class="navbar-right">
    <a id="navbarSearch" href="" class="search-link"><i data-feather="search"></i></a>
    <div class="dropdown dropdown-message">
      <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
        <i data-feather="message-square"></i>
        <span>5</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">New Messages</div>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/350" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <strong>Socrates Itumay</strong>
              <p>nam libero tempore cum so...</p>
              <span>Mar 15 12:32pm</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <strong>Joyce Chua</strong>
              <p>on the other hand we denounce...</p>
              <span>Mar 13 04:16am</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/600" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <strong>Althea Cabardo</strong>
              <p>is there anyone who loves...</p>
              <span>Mar 13 02:56am</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <strong>Adrian Monino</strong>
              <p>duis aute irure dolor in repre...</p>
              <span>Mar 12 10:40pm</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <div class="dropdown-footer"><a href="">View all Messages</a></div>
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-notification">
      <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
        <i data-feather="bell"></i>
        <span>2</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">Notifications</div>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/350" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
              <span>Mar 15 12:32pm</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <p><strong>Joyce Chua</strong> just created a new blog post</p>
              <span>Mar 13 04:16am</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/600" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <p><strong>Althea Cabardo</strong> just created a new blog post</p>
              <span>Mar 13 02:56am</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <a href="" class="dropdown-item">
          <div class="media">
            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            <div class="media-body mg-l-15">
              <p><strong>Adrian Monino</strong> added new comment on your photo</p>
              <span>Mar 12 10:40pm</span>
            </div><!-- media-body -->
          </div><!-- media -->
        </a>
        <div class="dropdown-footer"><a href="">View all Notifications</a></div>
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-profile">
      <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
        <div class="avatar avatar-sm"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
      </a><!-- dropdown-link -->
      <div class="dropdown-menu dropdown-menu-right tx-13">
        <div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
        <h6 class="tx-semibold mg-b-5">{{ Auth::user()->name }}</h6>
        <p class="mg-b-25 tx-12 tx-color-03">Administrator</p>

        <a href="{{URL::to('user/profile')}}" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
        <a href="{{URL::to('user/view')}}" class="dropdown-item"><i data-feather="user"></i> View Profile</a>
        <div class="dropdown-divider"></div>
        
        <a href="" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
        <a href="mailto:{{config('app.email_support')}}" class="dropdown-item"><i data-feather="help-circle"></i>Get Help</a>
        <a href="{{URL::to('logout')}}" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
      </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
  </div><!-- navbar-right -->
  <div class="navbar-search">
    <div class="navbar-search-header">
      <input type="search" class="form-control" placeholder="Type and hit enter to search...">
      <button class="btn"><i data-feather="search"></i></button>
      <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
    </div><!-- navbar-search-header -->
    <div class="navbar-search-body">
      <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent Searches</label>
      <ul class="list-unstyled">
        <li><a href="dashboard-one.html">modern dashboard</a></li>
        <li><a href="app-calendar.html">calendar app</a></li>
        <li><a href="../../collections/modal.html">modal examples</a></li>
        <li><a href="../../components/el-avatar.html">avatar</a></li>
      </ul>

      <hr class="mg-y-30 bd-0">

      <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions</label>

      <ul class="list-unstyled">
        <li><a href="dashboard-one.html">cryptocurrency</a></li>
        <li><a href="app-calendar.html">button groups</a></li>
        <li><a href="../../collections/modal.html">form elements</a></li>
        <li><a href="../../components/el-avatar.html">contact app</a></li>
      </ul>
    </div><!-- navbar-search-body -->
  </div><!-- navbar-search -->
</header><!-- navbar -->
@php //dd(set_menu(Auth::user()->group_id)) @endphp