const { Chartisan, ChartisanHooks }  = require('@chartisan/chartjs')

if (document.getElementById('claim-chart')) {
    new Chartisan({
        el: '#claim-chart',
        url: 'api/chart/claim_chart',
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Top 3 Governorat')
    });
}

if (document.getElementById('claim-sector-chart')) {
    new Chartisan({
        el: '#claim-sector-chart',
        url: 'api/chart/claim_chart?group=sector',
        hooks: new ChartisanHooks()
            .responsive()
            .datasets('doughnut')
            .title('Top 5 Secteur')
            .pieColors()
    });
}

