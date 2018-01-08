@extends('layouts.layout')

@section('content')

    <h3>Dashboard</h3>
    <hr>

    <section class="row text-center placeholders text-white">
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-info p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <h3>{{$byStatusSummary->isPartial}}</h3>
                <h6>Partial Donation</h6>
            </div>
        </div>
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-primary p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <h3>{{$byStatusSummary->isVerifiedOnly}}</h3>
                <h6>Verified Donation</h6>
            </div>
        </div>
        <div class="col-4 col-sm-3">
            <div class="placeholder bg-success p-3">
                {{--<i class="fa fa-2x fa-user"></i>--}}
                <h3>{{$byStatusSummary->isActive}}</h3>
                <h6>Active Donation</h6>
            </div>
        </div>
    </section>

    <section class="row">
        <div id="pichart1" class="col-4 border"></div>
        <div id="pichart2" class="col-4 border"></div>
        <div id="pichart3" class="col-4 border"></div>
    </section>
    <br>
    <section class="row">
        <div id="linechart1" class="col-12"></div>
    </section>

@endsection

@section('script')
    <script src="{{asset('chart/highcharts.js')}}"></script>
    <script src="{{asset('chart/modules/series-label.js')}}"></script>
    <script src="{{asset('chart/modules/exporting.js')}}"></script>
    <script type="text/javascript">

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
                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f}',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Value',
                colorByPoint: true,
                data: <?php echo $byFundCollectionAmountSummary;?>
            }]
        });


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
                text: 'Contributor Type FundCollection'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f}',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Value',
                colorByPoint: true,
                data: <?php echo $byContributorTypeFundCollection;?>
            }]
        });

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
                text: 'Contributor Type FundCollection'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f}',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Value',
                colorByPoint: true,
                data: <?php echo $byContributorTypeFundCollection;?>
            }]
        });


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
                categories: <?php echo $byMonthFundCollection_year;?>
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
                data: <?php echo $byMonthFundCollection_amount;?>
            }]

        });
    </script>
@endsection