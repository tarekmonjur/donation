@extends('layouts.layout')
@section('content')

    <h2>System Logs</h2>
    <div class="table-responsive">
        <table id="datatable1" class="table table-sm table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Host</th>
                <th>Pid</th>
                <th>Level</th>
                <th>Remote Address</th>
                <th>Remote Port</th>
                <th>Http Version</th>
                <th>URL</th>
                <th>Method</th>
                <th>Message</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$log->name or '---'}}</td>
                    <td>{{$log->hostname}}</td>
                    <td>{{$log->pid}}</td>
                    <td>{{$log->level}}</td>
                    <td>{{$log->remoteAddress}}</td>
                    <td>{{$log->remotePort}}</td>
                    <td>{{$log->req->httpVersion}}</td>
                    <td>{{$log->req->url}}</td>
                    <td>{{$log->req->method}}</td>
                    <td>{{$log->msg}}</td>
                    <td>{{date("d M Y h:i:s",strtotime($log->time))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection