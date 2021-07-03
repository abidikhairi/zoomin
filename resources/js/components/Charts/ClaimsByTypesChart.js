import React, { Component } from 'react';

class ClaimsByTypesChart extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {roomPresident} = this.props
        let chartElement = new Chartisan({
            el: '#claim-type',
            url: '/api/chart/claim_type_chart?roomPresident='+roomPresident,
            hooks: new ChartisanHooks()
                .responsive()
                .datasets('bar')
                .colors()
                .beginAtZero(true)
        });
        this.setState({
            chart: chartElement
        })
    }

    render() {
        return (<div className="card">
            <div className="card-header">
                Claims By Types
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="claim-type" style={{height: '400px'}} />
                </div>
            </div>
        </div>)
    }
}

export default ClaimsByTypesChart;
