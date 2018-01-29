@extends('layouts.layout')
@section('content')

    <h3>Medicine List</h3>

    <hr>

    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>Medicine Name</th>
                <th>Generic</th>
                <th>Manufacture</th>
                <th>Price (BDT)</th>
            </tr>
            </thead>
            <tbody style="font-size: 14px">
                <tr>
                    <td>1</td>
                    <td>medicine one</td>
                    <td>generic</td>
                    <td>pharma company</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>medicine two</td>
                    <td>generic</td>
                    <td>pharma company</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>medicine three</td>
                    <td>generic</td>
                    <td>pharma company</td>
                    <td>100</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection


