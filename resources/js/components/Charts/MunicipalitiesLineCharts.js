import React, {Component} from "react";


export default class MunicipalitiesLineCharts extends Component {
    constructor(props) {
        super(props)
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {governorate} = this.props
        let chartElement = new Chartisan({
            el: '#municipalities-nb-observations',
            url: '/zoomin/api/chart/municipalities_count_observations?governorate='+governorate.id,
            hooks: new ChartisanHooks()
                .responsive()
                .datasets({ type: 'line', fill: false })
                .colors()
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
                url: '/zoomin/api/chart/municipalities_count_observations?governorate=' + governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets({ type: 'line', fill: false })
                    .colors()
            })
        }

        return (<div className="card">
            <div className="card-header">
                البلديات
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="municipalities-nb-observations" style={{height: '400px', width: '100%'}}></div>
                </div>
            </div>
        </div>);
    }

}
