const { Chartisan, ChartisanHooks }  = require('@chartisan/chartjs')
const $ = require('jquery')

if (document.getElementById('claim-chart')) {
    const room_id = $('#claim-chart').data('room')

    new Chartisan({
        el: '#claim-chart',
        url: '/api/chart/claim_chart?room='+room_id,
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Top 3 Governorat')
    });
}

if (document.getElementById('claim-sector-chart')) {
    const room_id = $('#claim-chart').data('room')

    new Chartisan({
        el: '#claim-sector-chart',
        url: '/api/chart/claim_sector_chart?room='+room_id,
        hooks: new ChartisanHooks()
            .responsive()
            .datasets('doughnut')
            .pieColors()
    });
}

