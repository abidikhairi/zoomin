import React from "react";
import { Component } from "react";
import axios from "axios";
import Loader from "../Loader";

export default class ReportGovernorateTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            reports: null
        }
    }

    componentDidMount() {
        let { governorate, establishment } = this.props
        let endpoint = '/zoomin/api/report/{governorate}/{establishment}'
            .replace('{governorate}', governorate.id)
            .replace('{establishment}', establishment.id)

        axios.get(endpoint)
            .then(response => {
                this.setState({
                    isLoading: false,
                    reports: response.data
                })
            })
            .catch(err => {
                alert(err)
            })
    }

    render() {
        const { reports } = this.state;
        if (reports == null) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }
        return <div>
            {reports.map(report => {
                return (<table key={report.id} className="table table-hover">
                    <thead className="thead-dark">
                        <tr>
                            <th colSpan={2} className={'text-center'}>
                                {report.title.capitalize()}: {report.report_type.type}
                            </th>
                        </tr>
                        <tr>
                            <th>الاثر المالي</th>
                            <th>الملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                    {report.observations.map((observation) => <tr key={observation.id}><td>{observation.impact} TND</td><td>{observation.observation}</td></tr>)}
                    </tbody>
                </table>);
            })}
        </div>
    }
}
