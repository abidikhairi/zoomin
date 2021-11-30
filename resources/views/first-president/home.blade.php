@extends('layouts.member')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">الشكاوي المقبولة و المرفوضة
                        </div>
                        <div class="card-body">
                            <div class="c-chart-wrapper">
                                <div id="claim-chart" style="height: 300px;" data-room="-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">توزيع الشكاوي حسب القطاعات
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
                    التوزيع الجغرافي للشكاوي
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
