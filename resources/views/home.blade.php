@extends('layouts.app')
@section('content')
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">g2</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">g2squid</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                          {{ Auth::user()->name }}
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="{{ url('/settings') }}" class="btn btn-default btn-flat">Settings</a>
                        </div>
                        <div class="pull-right">
                          <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" 
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>  
                        </div>
                      </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                    <a href="#">
                      <i class="fa fa-dashboard"></i> <span>Streams</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-circle-o"></i> All Streams</a></li>
                        @if( count($all_streams) > 0)
                          @foreach ($all_streams as $stream)
                            <li><a href="{{ url('/edit-stream/'.$stream->id) }}"><i class="fa fa-circle-o"></i> {{ $stream->name }}</a></li>
                          @endforeach
                        @endif
                    </ul>
                </li>
                <li><a href="{{ url('/add-stream') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Add Stream</span></a></li>
                <li class="treeview">
                    <a href="#">
                      <i class="fa fa-dashboard"></i> <span>Pages</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        @if( count($all_pages) > 0)
                          @foreach ($all_pages as $page)
                            <li><a href="{{ url('/edit-page/'.$page->id) }}"><i class="fa fa-circle-o"></i> {{ $page->title }}</a></li>
                          @endforeach
                        @endif
                    </ul>
                </li>
                <li><a href="{{ url('/add-page') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Add Page</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

        @if (Route::getCurrentRoute()->getPath() == 'add-stream')
            @include('add')
        @elseif (Route::getCurrentRoute()->getPath() == 'edit-stream/{id}')
            @include('edit')
        @elseif (Route::getCurrentRoute()->getPath() == 'edit-page/{id}')
            @include('editpage')
        @elseif (Route::getCurrentRoute()->getPath() == 'add-page')
            @include('addpage')
        @elseif (Route::getCurrentRoute()->getPath() == 'settings')
            @include('settings')
        @else
            @include('listing')
        @endif

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="http://najeebmedia.com">N-Media</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->
@endsection