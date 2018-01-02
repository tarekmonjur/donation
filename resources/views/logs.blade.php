@extends('layouts.layout')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/beautify-json.css')}}">


    <h2>System Logs</h2>
    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead style="font-size: 12px">
            <tr>
                <th>#</th>
                <th>Host</th>
                <th>Pid</th>
                <th>Remote Address</th>
                <th>Http Version</th>
                <th>Action</th>
                <th>URL</th>
                <th>Method</th>
                <th>Message</th>
                <th style="width: 100px!important;">Time</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($logs as $log)
                <tr @if(isset($log->error) && $log->error->isError == true) class="bg-danger" @endif>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$log->hostname}}</td>
                    <td>{{$log->pid}}</td>
                    <td>{{$log->remoteAddress}}</td>
                    <td>{{$log->req->httpVersion}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-success" href="#" onclick="dataView('{{json_encode($log->req)}}', 'Request Object')"><i class="fa fa-reply-all" aria-hidden="true"></i></a>
                            @if(isset($log->error) && $log->error->isError == true)
                                <a class="btn btn-sm btn-primary" href="#" onclick="dataView('{{json_encode($log->error)}}', 'Error Object')"><i class="fa fa-window-close" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </td>
                    <td>{{$log->req->url}}</td>
                    <td>{{$log->req->method}}</td>
                    <td>{{$log->msg}}</td>
                    <td>{{date("d M Y h:i:s",strtotime($log->time))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade bd-example-modal-lg" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDataTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewData"></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/jquery.beautify-json.js')}}"></script>
    <script>
        function dataView(data, title){
            $("#viewDataTitle").html(title);
            $("#viewData").html(data);
            $('#viewData').beautifyJSON({
//                type: "plain"
//                type: "strict"
                type: "flexible"
            });
            $('#dataModal').modal();
        }
    </script>

@endsection