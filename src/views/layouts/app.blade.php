<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>后台</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet"/>

    @yield('style')

    <style>
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="container">
@if(!Auth::guest())
    <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="/admin" class="logo"><span>后台</span></a>
            <!--logo end-->

            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img src="{{ asset("img/default_avator.jpg") }}" height="29"
                                 width="29" alt="管理员头像"/>
                            <span class="username">
                            @if (Auth::guest())
                                    后台
                                @else
                                    {!! Auth::user()->name !!}
                                @endif
                        </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                {!! Form::open(['url'=>'/admin/logout']) !!}
                                <a class="btn btn-success" onclick="$(this).next().click()"><i class="fa fa-key"></i>退出</a>
                                {!! Form::submit("提交",['class'=>'hide']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </li>

                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
    @include('layouts.menu')

    <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <!--state overview start-->
                @yield('content')

            </section>

        </section>
        <!--main content end-->

        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                2016 &copy; Ricoo
                <a href="#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end-->
    @else
        <header class="header white-bg">
            <a href="javascript:" class="logo"><span>后台</span></a>
        </header>
        <section id="main-content">
            <section class="wrapper site-min-height">
                <!--state overview start-->
                @yield('content')
            </section>
        </section>
        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                2016 &copy; Ricoo
                <a href="#" class="go-top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!--footer end-->
    @endif
</section>
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.js"></script>

<!-- jQuery 2.1.4 -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- js placed at the end of the document so the pages load faster -->
<script class="include" type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/js/slidebars.min.js"></script>
<script src="/js/jquery.scrollTo.min.js"></script>
<script src="/js/common-scripts.js"></script>

@yield('scripts')

</body>
</html>
