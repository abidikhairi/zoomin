import React from 'react';

export default class FinancialImpact extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {
        let governorate = this.props.governorate

        let chartElement = new Chartisan({
            el: '#financial-impact',
            url: 'api/chart/financial_impact?id'+governorate.id,
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
        let { governorate } = this.props
        let { chart } = this.state
        if (chart) {
            chart.update({
                url: 'api/chart/financial_impact?id'+ governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card">
            <div className="card-header">
                Governorate: { governorate.name}
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="financial-impact" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }
}
