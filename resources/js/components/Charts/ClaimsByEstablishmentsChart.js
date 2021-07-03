import React, { Component } from "react";


class ClaimsByEstablishmentsChart extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {roomPresident} = this.props
        let chartElement = new Chartisan({
            el: '#claim-establishment',
            url: '/api/chart/claim_establishment_chart?roomPresident='+roomPresident,
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
        return (<div className="card">
            <div className="card-header">
                Claims By Establishment
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="claim-establishment" style={{height: '400px'}} />
                </div>
            </div>
        </div>);
    }
}

export default ClaimsByEstablishmentsChart;
