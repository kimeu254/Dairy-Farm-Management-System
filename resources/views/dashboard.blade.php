@extends('layouts.app')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                <h5 class="text-white op-7 mb-2"></h5>
            </div>
        </div>
    </div>
</div>
@role('owner|manager')
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Overall statistics</div>
                    <div class="card-category">Information about statistics in system</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <h6 class="fw-bold mt-3 mb-0">Cows</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Stalls</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Breeds</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Total income & spend statistics</div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                <h3 class="fw-bold">Kes {{$income}}</h3>
                            </div>
                            <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                <h3 class="fw-bold">Kes {{$expense}}</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="chart-container">
                                <canvas id="totalIncomeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">User Statistics</div>
                        <div class="card-tools">
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Daily Sales</div>
                    <div class="card-category">{{$date}}</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>Kes {{$milksaledaily}}</h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-right text-warning">Kes {{$trans}}</div>
                    <h2 class="mb-2">{{$leg_count}}</h2>
                    <p class="text-muted">Transactions</p>
                    <div class="pull-in sparkline-fix">
                        <div id="lineChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">Milk Production</h4>
                        <div class="card-tools">
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    <p class="card-category">
                    Cow and Milk Produced in Ltrs with their percentages</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        @foreach($milks as $milk)
                                        @php
                                        $all = \App\Models\Milk::get()->sum('total');
                                        $perc = round($milk->total/$all * 100)
                                        @endphp
                                        <tr>
                                            <td>{{$milk->cattle_no}}</td>
                                            <td class="text-right">
                                                {{$milk->total}}Ltrs
                                            </td>
                                            <td class="text-right">
                                                {{$perc}}%
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">Cattle Stalls</h4>
                        <div class="card-tools">
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    <p class="card-category">
                    List of Stalls and number of cows in each</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        @foreach($stalls as $milk)
                                        @php
                                        $allC = \App\Models\Cattle::where('status','Active')->count();
                                        $percount = round($milk->count/$allC * 100)
                                        @endphp
                                        <tr>
                                            <td>{{$milk->stall_no}}</td>
                                            <td class="text-right">
                                                {{$milk->count}}
                                            </td>
                                            <td class="text-right">
                                                {{$percount}}%
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Top Incomes</div>
                </div>
                <div class="card-body pb-0">
                    @foreach ($topIncomes as $item)
                    @php
                    $total_form = number_format($item->amount,2)    
                    @endphp
                    <div class="d-flex">
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">{{$item->tag->title}}</h6>
                            <small class="text-muted">{{$item->quantity}}{{$item->unit}}</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">Kes {{$total_form}}</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-title">Stock Usage Activity</div>
                </div>
                <div class="card-body">
                    <ol class="activity-feed">
                        @foreach ($usages as $item)
                        @php
                            $usedate = date("d F Y", strtotime($item->date));
                        @endphp
                        <li class="feed-item feed-item-secondary">
                            <time class="date" datetime="9-25">{{$usedate}}</time>
                            <span class="text">{{$item->inventory->ledger->name}} <a href="#">"{{$item->description}}"</a></span>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole
@endsection