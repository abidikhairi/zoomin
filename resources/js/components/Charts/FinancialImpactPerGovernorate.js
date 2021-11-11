import React, {Component} from "react";

export default class FinancialImpactPerGovernorate extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {
        let {governorate} = this.props

        let chartElement = new Chartisan({
            el: '#financial-impact-per-governorate',
            url: '/api/chart/financial_impact_per_governorate?governorate='+governorate.id,
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
        let {governorate} = this.props
        let { chart } = this.state
        if (chart) {
            chart.update({
                url: '/api/chart/financial_impact_per_governorate?governorate='+governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card mt-2">
            <div className="card-header">
                Financial Impact: Governorate
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="financial-impact-per-governorate" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }
}
