<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
   
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@yield('style')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
			
			<div class="col-md-3 left_col">
                @include('backend.partials.sidebar-menu')
            </div>
			
			<!-- top navigation -->
            @include('backend.partials.top-menu')
            <!-- /top navigation -->
			
			<!-- page content -->
            <div class="right_col" role="main">
                <div class="">

                    @yield('content')
                </div>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    ©
                    <?php echo(date('Y')) ?>. Quiz
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

	@yield('script')


</body>

</html>