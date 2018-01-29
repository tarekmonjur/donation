@extends('layouts.layout')
@section('content')

    <h3>Doctor List</h3>

    <hr>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>Doctor Name</th>
                <th>Doctor Phone</th>
                <th>BMDC</th>
                <th>Designation</th>
                <th>Chamber Address</th>
                <th>KOL Status</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
                <tr>
                    <td>1</td>
                    <td>Doctor 1</td>
                    <td>01234567890</td>
                    <td>123456</td>
                    <td>MBBS</td>
                    <td>Gulshan</td>
                    <td>status</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Doctor 2</td>
                    <td>01234567890</td>
                    <td>123456</td>
                    <td>MBBS</td>
                    <td>Gulshan</td>
                    <td>status</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Doctor 3</td>
                    <td>01234567890</td>
                    <td>123456</td>
                    <td>MBBS</td>
                    <td>Gulshan</td>
                    <td>status</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

