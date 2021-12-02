import React, { Component } from 'react'

export default class FinancialImpactPerRoom extends Component {

    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {
        let {room} = this.props

        let chartElement = new Chartisan({
            el: '#financial-impact-per-room',
            url: '/zoomin/api/chart/financial_impact_per_room?room='+room.id,
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
        let {room} = this.props
        let { chart } = this.state
        if (chart) {
            chart.update({
                url: '/zoomin/api/chart/financial_impact_per_room?room='+room.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card mt-2">
            <div className="card-header">
                الاثر المالي حسب الدوائر
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="financial-impact-per-room" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }
}
