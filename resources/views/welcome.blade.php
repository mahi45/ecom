<!doctype html>

<html lang="en">

 

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Toaster CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <style>

        .toast-success {

            opacity: 1 !important;

        }

 

        .toast-error {

            opacity: 1 !important;

        }

 

        .toast-warning {

            opacity: 1 !important;

        }

    </style>

 

    <title>Toastr</title>

</head>

 

<body>

    <div class="container text-center p-5">

        <form action="{{ url('/success') }}" method="GET" class="my-5">

            <button type="submit" class="btn btn-success btn-lg">Show success toastr</button>

        </form>

        <form action="{{ url('/warning') }}" method="GET" class="my-5">

            <button type="submit" class="btn btn-warning btn-lg">Show warning toastr</button>

        </form>

        <form action="{{ url('/error') }}" method="GET" class="my-5">

            <button type="submit" class="btn btn-danger btn-lg">Show error toastr</button>

        </form>

    </div>

    <!-- Jquery CDN -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Toastr CDN -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>

        toastr.options = {

            "closeButton": true,

            "showDuration": "300",

            "hideDuration": "1000",

            "timeOut": "5000",

            "extendedTimeOut": "1000",

        }

    </script>

 

    @if(Session::has('success'))

    <script>

        toastr.success("{{ Session::get('success') }}");

    </script>

    @elseif(Session::has('warning'))

    <script>

        toastr.warning("{{ Session::get('warning') }}");

    </script>

    @elseif(Session::has('error'))

    <script>

        toastr.error("{{ Session::get('error') }}");

    </script>

    @endif

</body>


 

</html>