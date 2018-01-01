@extends('layouts.layout')
@section('content')

    <h2>System Logs</h2>
    <div class="table-responsive">
        <table id="datatable1" class="table table-sm table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Level</th>
                <th>Url</th>
                <th>Method</th>
            </tr>
            </thead>
            <tbody>
            {{--@foreach($logs as $log)--}}
                {{--<tr>--}}
                    {{--<td>{{$loop->iteration}}</td>--}}
                    {{--<td>{{$log->diseaseStage}}</td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            </tbody>
        </table>
    </div>


@endsection