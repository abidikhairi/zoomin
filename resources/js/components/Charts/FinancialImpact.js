import React from 'react';

export default class FinancialImpact extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {

        let chartElement = new Chartisan({
            el: '#financial-impact',
            url: '/api/chart/financial_impact',
            hooks: new ChartisanHooks()
                .responsive()
                .datasets('pie')
                .pieColors()
        });
        this.setState({
            chart: chartElement
        })
    }

    render() {
        let { chart } = this.state
        if (chart) {
            chart.update({
                url: '/api/chart/financial_impact',
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card">
            <div className="card-header">
                الاثر المالي
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="financial-impact" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }
}
