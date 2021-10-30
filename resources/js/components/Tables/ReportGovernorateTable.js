import React from "react";
import { Component } from "react";


export default class ReportGovernorateTable extends Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        let { governorate, establishment } = this.props
        console.log(governorate)
        console.log(establishment)
        // TODO: get all reports in this governorate
    }

    render() {
        return <h2>Draw Table of reports by chosen governorate</h2>
    }
}
