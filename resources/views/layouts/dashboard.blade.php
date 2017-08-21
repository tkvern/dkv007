@extends('layouts.plane')

@section('body')
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/') }}">量子云</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->username }}  <i class="fa fa-caret-down fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url ('user/profile') }}"><i class="fa fa-user fa-fw"></i>个人信息</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                                <i class="fa fa-sign-out fa-fw"></i> 安全退出
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> 控制台</a>
                        </li>
                        <li>
                            <a href="{{ url ('orders') }}" {{ (Request::is('orders/*') ? 'class=active' : '') }}><i class="fa fa-shopping-cart fa-fw"></i> 订单</a>
                        </li>
                        <li>
                            <a href="{{ url ('tasks') }}" {{ (Request::is('tasks/*') ? 'class=active' : '') }}><i class="fa fa-tasks fa-fw"></i> 作业</a>
                        </li>
                        <li>
                            <a href="{{ url ('upload/index') }}" {{ (Request::is('upload/*') ? 'class=active' : '') }}><i class="fa fa-image fa-fw"></i> 全景H5</a>
                        </li>
                        <li>
                            <a href="{{ url ('activities/index') }}" {{ (Request::is('activities/*') ? 'class=active' : '') }}><i class="fa fa-clone fa-fw"></i> 全景活动</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> 账户设置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url ('user/profile') }}">个人资料</a>
                                </li>
                                <li>
                                    <a href="{{ url ('user/password') }}">密码管理</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
           </div>
			<div class="row">  
				@yield('section')

            </div>
        </div>
    </div>
@stop