import React, {Component} from "react";

export default class ObservationPerGovernorate extends Component {
    constructor(props) {
        super(props);

        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {governorate} = this.props
        let chartElement = new Chartisan({
            el: '#nb-observations-per-governorate',
            url: '/api/chart/observations_governorate?governorate='+governorate.id,
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
                url: '/api/chart/observations_governorate?governorate='+governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('pie')
                    .pieColors()
            })
        }

        return (<div className="card">
            <div className="card-header">
                # Observations Per Governorate
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="nb-observations-per-governorate" style={{height: '300px'}}></div>
                </div>
            </div>
        </div>);
    }

}
