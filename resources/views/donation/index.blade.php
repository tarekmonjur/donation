@extends('layouts.layout')
@section('content')

    <h2>Donations</h2>
    @if($auth->user_type != "company")
    <form action="" method="get" class="form-inline" style="position: absolute;left: 20%;top: 50px; z-index:999">
        <div class="form-group">
            <label><strong>Partial : </strong></label>
            <select class="form-control form-control-sm col-form-label-sm mx-sm-2" name="isPartial">
                <option value="1" @if($isPartial == true) selected @endif>Yes</option>
                <option value="0" @if($isPartial == false) selected @endif>No</option>
            </select>
        </div>

        <div class="form-group">
            <label><strong>Verified : </strong></label>
            <select class="form-control form-control-sm col-form-label-sm mx-sm-2" name="isVerified">
                <option value="1" @if($isVerified == true) selected @endif>Yes</option>
                <option value="0" @if($isVerified == false) selected @endif>No</option>
            </select>
        </div>

        <div class="form-group">
            <label><strong>Active : </strong></label>
            <select class="form-control form-control-sm col-form-label-sm mx-sm-2" name="isActive">
                <option value="1" @if($isActive == true) selected @endif>Yes</option>
                <option value="0" @if($isActive == false) selected @endif>No</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="search" class="btn btn-primary btn-sm form-control-sm">Submit</button>
        </div>
    </form>
    @endif
    <div class="table-responsive">
        <table id="datatable1" class="table table-hover">
            <thead>
            <tr style="font-size: 12px" class="bg-light">
                <th>#</th>
                <th>Title</th>
                <th>Disease Stage</th>
                <th>Target Amount</th>
                <th>Target Date</th>
                <th>Collected Amount</th>
                <th>Active Program</th>
                <th>Fund Summary</th>
                <th>Status</th>
                @if($auth->user_type != "company")
                <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody style="font-size: 14px">
            @foreach($donations as $donation)
                <?php
                $fund_collect = collect($donation->funds);
                $fund_isVerified = $fund_collect->where('isVerified',1)->count();
                $fund_NotVerified = $fund_collect->where('isVerified',0)->count()
                ?>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{url('donations/'.$donation->{'_id'})}}">{{$donation->title}}</a></td>
                <td>{{$donation->diseaseStage}}</td>
                <td>{{$donation->targetAmount}}</td>
                <td>{{date("d M Y",strtotime($donation->targetDate))}}</td>
                <td>{{$donation->collectedAmount}}</td>
                <td>@if(isset($donation->isVerified) && $donation->activeProgram) <span class="badge badge-success">Yes</span> @else <span class="badge badge-danger">No</span> @endif</td>
                <td>
                    <span class="badge badge-success">{{$fund_isVerified}}</span>
                    <span class="badge badge-danger">{{$fund_NotVerified}}</span>
                </td>
                <td>
                    @if(isset($donation->isVerified) && $donation->isVerified == true)
                        <span class="badge badge-success">Verified</span>
                    @else
                        <span class="badge badge-danger">Unverified</span>
                    @endif
                </td>
                @if($auth->user_type != "company")
                <td>
                    <div class="btn-group">
                        @if(isset($donation->isPartial) && $donation->isPartial == false)
                            @if(isset($donation->isVerified) && $donation->isVerified == true)
                                <a class="btn btn-sm btn-danger" href="#" onclick="return confirmAction('Unverified','Are you sure unverified this?','{{url('/donations/verify/'.$donation->{'_id'}.'/0')}}')">Unverified</a>
                            @else
                                <a class="btn btn-sm btn-success" href="#" onclick="return confirmAction('verify','Are you sure verify this?','{{url('/donations/verify/'.$donation->{'_id'}.'/1')}}')">Verify</a>
                            @endif
                        @endif
                        <a class="btn btn-sm btn-primary" href="{{url('/donations/edit/'.$donation->{'_id'})}}">Edit</a>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection