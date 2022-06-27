@extends('voyager::master')

@php
    $selectTime = app('request')->input('time');
    $selectData = app('request')->input('data');
    $listSelectTime = DB::table('data_kegiatans')->select(DB::raw('count(id) as `data`'),DB::raw("CONCAT_WS('-',YEAR(created_at),MONTH(created_at)) as time"))->groupby('time')->get();

    $timenow = Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");
    $timetoday = Carbon\Carbon::today()->toDateString();

    if($selectTime){
        $timemonth = Carbon\Carbon::create($selectTime)->month;
        $timeyear = Carbon\Carbon::create($selectTime)->year;
        $monthnow = Carbon\Carbon::create($selectTime)->formatLocalized("%B");
    } else {
        $timemonth = Carbon\Carbon::now()->month;
        $timeyear = Carbon\Carbon::now()->year;
        $monthnow = Carbon\Carbon::now()->formatLocalized("%B");
    }
    
    $today = today(); 
    $dates = []; 
    for($i=1; $i < $today->daysInMonth + 1; ++$i) {
        $dates[] = Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('j M');
    }
    $listDate = json_encode($dates);

    $dataPetugasToday = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select('data_kegiatans.user_id', 'users.name', DB::raw('count(*) as total'))->whereDate('data_kegiatans.created_at', $timetoday)->orderByDesc('total')->groupBy('user_id')->get();
    
    $dataPetugasMonth = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select('data_kegiatans.user_id', 'users.name', DB::raw('count(*) as total'))->whereYear('data_kegiatans.created_at', $timeyear)->whereMonth('data_kegiatans.created_at', $timemonth)->orderByDesc('total')->groupBy('user_id')->get();
    $getListPetugas = App\User::where('id', '!=', 1)->where('id', '!=', 2)->get();
    foreach ($getListPetugas as $key => $dataPetugas) {
        $getListArrPetugas = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select(DB::raw('DATE(data_kegiatans.created_at) as x'), DB::raw('count(*) as y'))->whereYear('data_kegiatans.created_at', $timeyear)->whereMonth('data_kegiatans.created_at', $timemonth)->where('user_id', $dataPetugas->id)->groupByRaw('DATE(data_kegiatans.created_at)')->get();
        
        $objPetugas[$key] = array(
            'name' => $dataPetugas->name,
            'data' => $getListArrPetugas
        );
    }
@endphp

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="container">
            <h2>Selamat Datang<i class="voyager-bolt"></i></h2><br>

            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($selectTime)
                        Bulan {{date_format(date_create($selectTime), "F Y")}} - total {{$selectData}} data <span class="caret"></span>
                    @else
                        Pilih Bulan <span class="caret"></span>
                    @endif
                </button>
                <ul class="dropdown-menu">
                    @foreach ($listSelectTime as $listTime)
                        <li><a href="/admin?time={{$listTime->time}}&data={{$listTime->data}}">{{date_format(date_create($listTime->time), "F Y")}}</a></li>
                    @endforeach
                </ul>
            </div><br><br>
            
            <div class="row">
                <div class="col-md-6">
                    <b><u>Target Bulan {{$monthnow}}</u></b><br>
                    <div class="bar-container">
                        <table width="100%">
                            @foreach ($dataPetugasMonth as $petugas)
                            <tr>
                                <td style="width:1%; white-space: nowrap; padding: 0 10px 0 0;"><h4>{{$petugas->name}}</h4></td>
                                <td>
                                    <b>{{$petugas->total}} ({{round(min(100, $petugas->total/154*100), 2)}}%)</b>

                                    @if (round(min(100, $petugas->total/154*100), 2) < 20)
                                        <div class="meter red nostripes">
                                            <span style="width: {{round(min(100, $petugas->total/154*100), 2)}}%"></span>
                                        </div>
                                    @elseif (round(min(100, $petugas->total/154*100), 2) < 80)
                                        <div class="meter orange nostripes">
                                            <span style="width: {{round(min(100, $petugas->total/154*100), 2)}}%"></span>
                                        </div>
                                    @else
                                        <div class="meter nostripes">
                                            <span style="width: {{round(min(100, $petugas->total/154*100), 2)}}%"></span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <b><u>Target Hari ini:</u> {{$timenow}}</b><br>
                    <div class="circle-container">
                        @foreach ($dataPetugasToday as $petugas)
                            <div class="circle-big">
                                <div class="text">
                                    {{$petugas->total}}<div class="small">{{$petugas->name}}</div>
                                </div>
                                <svg>
                                    <circle class="bg" cx="57" cy="57" r="52"></circle>
                                    @if ($petugas->total > 6)
                                        <circle class="progress" cx="57" cy="57" r="52" style="stroke:#48ad2f; stroke-dasharray:400;"></circle>
                                    @elseif ($petugas->total > 4)
                                        <circle class="progress" cx="57" cy="57" r="52" style="stroke:#9b9b9b; stroke-dasharray:291;"></circle>
                                    @else
                                        <circle class="progress" cx="57" cy="57" r="52" style="stroke:#9b9b9b; stroke-dasharray:194;"></circle>
                                    @endif
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

<script>
window.onload = function () {
    var options = {
        series: {!! json_encode($objPetugas) !!},
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: true
            },
            animations: {
                enabled: false
            }
        },
        title: {
            text: 'Grafik Pekerjaan Bulan {{$monthnow}}',
            align: 'left'
        },
        xaxis: {
            type: "datetime",
            title: {
                text: 'Tanggal'
            }
        },
        yaxis: {
            title: {
                text: 'Total Pekerjaan'
            }
        },
        colors: ['#00A5E3', '#FC6238', '#C05780', '#6C88C4', '#FF5C77', '#0065A2', '#00CDAC', '#FF96C5'],
        dataLabels: {
          enabled: true
        },
        markers: {
          size: 1
        },
        stroke: {
            width: 2
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}
</script>

@stop
