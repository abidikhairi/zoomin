import React from 'react';


export default class FaultChart extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null,
        }
    }

    componentDidMount() {
        let governorate = this.props.governorate

        let chartElement = new Chartisan({
            el: '#governorate-fault',
            url: 'api/chart/fault_chart?id'+governorate.id,
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
                url: 'api/chart/fault_chart?id'+ governorate.id,
                hooks: new ChartisanHooks()
                    .responsive()
                    .datasets('doughnut')
                    .pieColors()
            })
        }

        return (<div className="card">
                    <div className="card-header">
                        Governorate: { governorate.name}
                    </div>
                    <div className="card-body">
                        <div className="c-chart-wrapper">
                            <div id="governorate-fault" style={{height: '300px'}} />
                        </div>
                    </div>
                </div>);
    }
}
