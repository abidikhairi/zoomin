import React, { Component } from "react";

export default class NbObservationPerSector extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let chartElement = new Chartisan({
            el: '#nb-observations-per-sector',
            url: '/api/chart/nb_observation_sector',
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
                url: '/api/chart/nb_observation_sector',
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card">
            <div className="card-header">
                عدد الملاحظات حسب القطاعات
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="nb-observations-per-sector" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }
}
