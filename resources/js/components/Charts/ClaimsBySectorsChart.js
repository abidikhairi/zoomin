import React, { Component } from 'react'

class ClaimsBySectorsChart extends Component {

    constructor(props) {
        super(props);
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {roomPresident} = this.props
        let chartElement = new Chartisan({
            el: '#claim-sector',
            url: '/api/chart/claim_sector_chart?roomPresident='+roomPresident,
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
                    <div id="claim-sector" style={{height: '400px'}} />
                </div>
            </div>
        </div>);
    }

}

export default ClaimsBySectorsChart
