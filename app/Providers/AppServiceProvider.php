<?php

namespace App\Providers;

use App\Charts\ClaimByEstablishmentChart;
use App\Charts\ClaimByProfileChart;
use App\Charts\ClaimBySectorChart;
use App\Charts\ClaimByTypeChart;
use App\Charts\ClaimChart;
use App\Charts\FaultChart;
use App\Charts\FinancialImpactChart;
use App\Charts\FinancialImpactPerGovernorate;
use App\Charts\FinancialImpactPerRoom;
use App\Charts\GovernorateChart;
use App\Charts\MunicipalitiesNbObservations;
use App\Charts\NbObservationsPerSector;
use App\Charts\ObservationsPerGovernorate;
use App\Charts\ReportPerYearChart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @param Charts $charts
     * @return void
     */
    public function boot(Charts $charts)
    {
        DB::table('governorates')->lockForUpdate();

        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath('');
                });
        }

        Paginator::useBootstrap();

        $charts->register([
            ClaimChart::class,
            GovernorateChart::class,
            FaultChart::class,
            ReportPerYearChart::class,
            FinancialImpactChart::class,
            ClaimByProfileChart::class,
            ClaimByEstablishmentChart::class,
            ClaimBySectorChart::class,
            ClaimByTypeChart::class,
            FinancialImpactPerRoom::class,
            FinancialImpactPerGovernorate::class,
            MunicipalitiesNbObservations::class,
            NbObservationsPerSector::class,
            ObservationsPerGovernorate::class
        ]);
    }
}
