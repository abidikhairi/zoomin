import React, { Component } from 'react';


class ClaimsByProfileChart extends Component {
    constructor(props) {
        super(props);
        this.state = {
            chart: null
        }
    }

    componentDidMount() {
        let {roomPresident} = this.props

        let chartElement = new Chartisan({
            el: '#claim-profile',
            url: '/api/chart/claim_profile_chart?roomPresident='+roomPresident,
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
                Claims By Profile:
            </div>
            <div className="card-body">
                <div className="c-chart-wrapper">
                    <div id="claim-profile" style={{height: '400px'}} />
                </div>
            </div>
        </div>);
    }
}

export default ClaimsByProfileChart
