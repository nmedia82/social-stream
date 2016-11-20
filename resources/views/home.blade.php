@extends('layouts.app')
@section('content')
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">SS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Social</b>Stream</span>
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
                          <a href="#" class="btn btn-default btn-flat">Profile</a>
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
                <li class="active treeview">
                    <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Streams</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> All Streams</a></li>
                        <li><a href="index.html"><i class="fa fa-circle-o"></i> Stream 1</a></li>
                        <li><a href="index2.html"><i class="fa fa-circle-o"></i> Stream 2</a></li>
                    </ul>
                </li>
                <li class="header">Settings</li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Add Stream</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Social Streams</h3>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Stream Title</th>
                                <th>Shortcode</th>
                                <th>Social Networks</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>A test stream</td>
                            <td>[stream id="1"]</td>
                            <td>5</td>
                            <td>25 July 2015</td>
                            <td>
                                <button class="btn btn-info btn-xs">Edit</button>
                                <button class="btn btn-danger btn-xs">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Another stream</td>
                            <td>[stream id="2"]</td>
                            <td>13</td>
                            <td>26 June 2015</td>
                            <td>
                                <button class="btn btn-info btn-xs">Edit</button>
                                <button class="btn btn-danger btn-xs">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Stream Title</th>
                                <th>Shortcode</th>
                                <th>Social Networks</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
    </div>
<!-- /.content-wrapper -->
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