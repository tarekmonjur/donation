<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>{{ config('app.name', 'AFC DONATION') }}</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datepicker.standalone.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/sweetalert2.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
        .box_shadow{
            box-shadow: 0px 0px 3px 0px #e9ecef!important;
        }
    </style>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

</head>

<body>
    @include('layouts.common.header')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.common.sidebar')

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                @if(Session('msg_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{Session('msg_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(Session('msg_error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> {{Session('msg_error')}}
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>


    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        var baseUrl = '{{url('/')}}';


//        function PrintInvoice(elem){
//            var invoice_print = document.getElementById('invoice_print');
//            invoice_print.style.visibility='hidden';
//
//            var mywindow = window.open('', 'printwindow');
//            mywindow.document.write('<html><head><title>Invoice</title>' +
//                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/css/AdminLTE.min.css" />' +
//                '<link rel="stylesheet" type="text/css" href="'+baseUrl+'/bower_components/bootstrap/dist/css/bootstrap.min.css" />');
//            mywindow.document.write('</head><body>');
//            mywindow.document.write(document.getElementById(elem).innerHTML);
//            mywindow.document.write('</body></html>');
//            setTimeout(function () {
//                mywindow.print();
//                mywindow.close();
//                invoice_print.style.visibility='visible';
//            }, 500);
//            return true;
//        }

        function confirmAction(btn, message, url){
            swal({
                title: message,
//                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, '+btn+' it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                window.location.href = url;
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            })
        }

        $(function () {
//            $('#datepicker').datepicker();

            $('#datatable1').DataTable();
            $('#datatable2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        });
    </script>
@yield('script')
</body>
</html>
