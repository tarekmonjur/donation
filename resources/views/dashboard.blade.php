@extends('layouts.layout')

@section('content')

    <h3>Dashboard</h3>
    <hr>

    @if($auth->user_type == 'admin')
    <section class="row justify-content-center text-center placeholders text-white">
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-info p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <a href="{{url('donations?isPartial=1&isVerified=0&isActive=0&search=')}}" class="text-white">
                <h3 id="isPartial">{{$byStatusSummary->isPartial}}</h3>
                <h6>Partial Programs</h6>
                </a>
            </div>
        </div>
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-primary p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <h3 id="isVerifiedOnly">{{$byStatusSummary->isVerifiedOnly}}</h3>
                <h6>Verified Programs</h6>
            </div>
        </div>
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-success p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <h3 id="isActive">{{$byStatusSummary->isActive}}</h3>
                <h6>Active Programs</h6>
            </div>
        </div>
    </section>
    @endif

    <section class="row">
        @if($chart_one == true)
        <div id="pichart1" class="col-6 border" style="min-height: 400px"></div>
        @else
        <div class="col-6 border" style="min-height: 400px"><h4>Not Data Available</h4></div>
        @endif

        @if($chart_two)
        <div id="pichart2" class="col-6 border" style="min-height: 400px"></div>
        @else
        <div class="col-6 border" style="min-height: 400px"><h4>Not Data Available</h4></div>
        @endif

        @if($auth->user_type == 'admin')
            @if($chart_three)
            <div id="pichart3" class="col-12 border" style="min-height: 400px"></div>
            @else
            <div class="col-12 border" style="min-height: 400px"><h4>Not Data Available</h4></div>
            @endif
        @endif
    </section>
    <br>
    @if($auth->user_type == 'admin')
    <section class="row">
        @if($chart_four)
        <div id="linechart1" class="col-12" style="min-height: 400px"></div>
        @else
        <div class="col-12 border" style="min-height: 400px"><h4>Not Data Available</h4></div>
        @endif
    </section>
    @endif

@endsection

@section('script')
    <script src="{{asset('chart/highcharts.js')}}"></script>
    <script src="{{asset('chart/modules/series-label.js')}}"></script>
    <script src="{{asset('chart/modules/exporting.js')}}"></script>
    <script type="text/javascript">
        var baseUrl = '{{url('/')}}';
        var authType = '{{$auth->user_type}}';
//        console.log(authType);

        var byFundCollectionAmountSummary = JSON.parse('<?php echo $byFundCollectionAmountSummary;?>');
        var byContributorTypeFundCollection = JSON.parse('<?php echo $byContributorTypeFundCollection;?>');
        var byStatusFundCollection = JSON.parse('<?php echo $byStatusFundCollection;?>');
        var byMonthFundCollection_year = JSON.parse('<?php echo $byMonthFundCollection_year;?>');
        var byMonthFundCollection_amount = JSON.parse('<?php echo $byMonthFundCollection_amount;?>');
//        console.log(byFundCollectionAmountSummary);

        var ct1 = JSON.parse('<?php echo $chart_one;?>');
        var ct2 = JSON.parse('<?php echo $chart_two;?>');
        var ct3 = JSON.parse('<?php echo $chart_three;?>');
        var ct4 = JSON.parse('<?php echo $chart_four;?>');

        if(ct1 == true){pichart1(byFundCollectionAmountSummary);}
        if(ct2 == true){pichart2(byContributorTypeFundCollection);}

        if(authType == "admin" && ct3 == true){pichart3(byStatusFundCollection);}
        if(authType == "admin" && ct4 == true){linechart1(byMonthFundCollection_year, byMonthFundCollection_amount);}

        $(document).ready(function () {
            setInterval(function(){
                $.ajax({
                    url : baseUrl+"/",
                    type : "get",
                    dataType: "json",
                    success: function (data) {
//                        console.log(JSON.parse(data.byFundCollectionAmountSummary));
                        if(authType == "admin") {
                            document.getElementById('isPartial').innerHTML = data.byStatusSummary.isPartial;
                            document.getElementById('isVerifiedOnly').innerHTML = data.byStatusSummary.isVerifiedOnly;
                            document.getElementById('isActive').innerHTML = data.byStatusSummary.isActive;
                        }

                        var ct1 = data.chart_one;
                        var ct2 = data.chart_two;
                        var ct3 = data.chart_three;
                        var ct4 = data.chart_four;

//                        console.log(data,ct1,ct2);

                        if(ct1 == true){pichart1(JSON.parse(data.byFundCollectionAmountSummary));}
                        if(ct2 == true){pichart2(JSON.parse(data.byContributorTypeFundCollection));}
                        if(authType == "admin" && ct3 == true){pichart3(JSON.parse(data.byStatusFundCollection));}
                        if(authType == "admin" && ct4 == true){linechart1(JSON.parse(data.byMonthFundCollection_year), JSON.parse(data.byMonthFundCollection_amount));}

                    },
                    error: function (error) {

                    }
                });
            }, 15000);
        });


        function pichart1(byFundCollectionAmountSummary)
        {
            Highcharts.chart('pichart1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Fund Collection Amount Summary'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Value',
                    colorByPoint: true,
                    data: byFundCollectionAmountSummary
                }]
            });
        }


        function pichart2(byContributorTypeFundCollection)
        {
            Highcharts.chart('pichart2', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Contributor Type Fund Collection'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Value',
                    colorByPoint: true,
                    data: byContributorTypeFundCollection
                }]
            });
        }


        function pichart3(byStatusFundCollection)
        {
            Highcharts.chart('pichart3', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Status Fund Collection'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Value',
                    colorByPoint: true,
                    data: byStatusFundCollection
                }]
            });
        }


        function linechart1(byMonthFundCollection_year, byMonthFundCollection_amount)
        {
            Highcharts.chart('linechart1', {
                chart: {
                    type: 'line'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: 'Month Fund Collection'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: byMonthFundCollection_year
                },
                yAxis: {
                    title: {
                        text: 'Amounts'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Fund',
                    data: byMonthFundCollection_amount
                }]

            });
        }

    </script>
@endsection