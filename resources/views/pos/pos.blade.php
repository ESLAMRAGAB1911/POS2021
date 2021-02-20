<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleScript() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
   
    <title>POS</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('dashboard/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!--awesome-->
    <link href="{{asset('dashboard/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/style-responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <style>
        .mr-2{
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                 -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>

<body>
    @include('pos._navbar')
    <!--sidebar end-->

    @yield('content')


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="{{asset('dashboard/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/lib/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('dashboard/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="{{asset('dashboard/lib/common-scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    {{-- custom js --}}
    <script src="{{asset('dashboard/custom/orders.js')}}"></script>
    <script src="{{asset('dashboard/lib/printThis.js')}}" type="text/javascript"></script>

    
    <script>
        @if(session('Delete'))

        $(document).ready(function() {

            // for errors - red box
            toastr.error("{{__('site.Success Delete')}}");

        });

        @endif
        @if(session('Add'))
        $(document).ready(function() {

            // for errors - red box
            toastr.success("{{__('site.Success Add')}}");

        });

        @endif
        @if(session('Edit'))
        $(document).ready(function() {

            // for errors - red box
            toastr.info("{{__('site.Success Edit')}}");

        });

        @endif

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
            }

            $("#imgInp").change(function() {
            readURL(this);
            });
    </script>
    
</body>

</html>
