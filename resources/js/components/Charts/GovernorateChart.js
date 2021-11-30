import React from "react";

export default class GovernorateChart extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {
        let governorate = this.props.governorate

        let chartElement = new Chartisan({
            el: '#claim-governorate-sector',
            url: '/api/chart/chart_governorate?governorate='+governorate.id,
            hooks: new ChartisanHooks()
                .responsive()
                .datasets('doughnut')
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
                url: '/api/chart/chart_governorate?governorate='+ governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('doughnut')
                    .pieColors()
            })
        }

        return (<div className="card">
            <div className="card-header">الولاية: { governorate.name}
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="claim-governorate-sector" style={{height: '300px'}} />
                </div>
            </div>
        </div>
        );
    }
}
