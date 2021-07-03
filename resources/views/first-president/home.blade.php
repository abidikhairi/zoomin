@extends('layouts.member')

@section('content')<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Pie Chart
                            <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org" target="_blank"><small class="text-muted">docs</small></a></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper">
                                <div id="claim-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Pie Chart
                            <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org" target="_blank"><small class="text-muted">docs</small></a></div>
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper">
                                <div id="claim-sector-chart" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8" style="height: auto;">
            <div class="card">
                <div class="card-header">
                    Tunisia Map
                </div>
                <div class="card-body">
                    <div id="map-app">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
