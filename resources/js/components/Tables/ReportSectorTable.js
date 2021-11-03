import React, {Component} from 'react';
import axios from "axios";

export default class ReportSectorTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            reports: [],
            establishments: [],
        }
    }

    componentDidMount() {
        let { sector, governorate } = this.props
        if (sector) {
            if (governorate) {
                    axios.get('/api/report/sector/'+sector.id+'/'+governorate.id)
                        .then(response => {
                            this.setState({
                                reports: response.data
                            })
                        }).catch(err => {
                        alert(err)
                    })
                axios.get('api/governorate/'+governorate.id+'/establishment')
                    .then(response => {
                        this.setState({
                            establishments: response.data
                        })
                    }).catch(err => {
                    alert(err)
                })
            }else {
                axios.get('/api/report/sector/' + sector.id)
                    .then(response => {
                        this.setState({
                            reports: response.data
                        })
                    }).catch(err => {
                    alert(err)
                })
            }
        } else {
            axios.get('/api/report')
                .then(response => {
                    this.setState({
                        reports: response.data
                    })
                }).catch(err => {
                    alert(err)
                })
        }
    }

    reloadReportWithGovernorate() {
        let {sector, governorate} = this.props

        axios.get('/api/report/sector/'+sector.id+'/'+governorate.id)
            .then(response => {
                this.setState({
                    reports: response.data
                })
            }).catch(err => {
                alert(err)
            })
        return true;
    }

    filterReports(establishment) {
        let {governorate} = this.props
        let {reports} = this.state

        let newReports = reports.filter(report => report.establishment_id === establishment.id && report.establishment.governorate_id === governorate.id)
        console.log(newReports)
        this.setState({
            reports: newReports
        })
    }

    render() {
        let { governorate } = this.props
        let { reports, establishments } = this.state
        let reportsView = reports.map(report => {
            return (<table key={report.id} className="table table-hover">
                <thead className="thead-dark">
                <tr>
                    <th colSpan={2} className={'text-center'}>
                        {report.title.capitalize()}: {report.report_type.type}
                    </th>
                </tr>
                <tr>
                    <th>Financial Impact</th>
                    <th>Observation</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>);
        })

        let showEstablishmentsDropdown = governorate !== null


        return (<div className="card">
            <div className="card-header">
                Liste Des Rapport
                {showEstablishmentsDropdown ? <div className="dropdown float-right">
                    <button className="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button"
                            id="list-establishment-sector-table" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> Establishments
                    </button>
                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="list-establishment-sector-table">
                        {establishments.map(establishment => <a key={establishment.id} className="dropdown-item small text-muted" href="#" onClick={() => this.filterReports(establishment)}>{establishment.name}</a>)}
                    </div>
                </div>: null}
            </div>
            <div className="card-body">
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th className={'text-center'}>
                            Title
                        </th>
                        <th>Observations</th>
                        <th>PDF</th>
                    </tr>
                    </thead>
                        {reports.map(report => {
                            return <tr key={report.id}>
                                <td>{report.title}</td>
                                <td>
                                    <a href={'/report/{report}/observation'.replace('{report}', report.id)} target={'_blank'} className={'btn btn-sm btn-primary'}>
                                        Voir Observations
                                    </a>
                                </td>
                                <td>
                                    <a href={'storage/reports/'+report.pdf_file} target={'_blank'} className={'btn btn-sm btn-info'}>Télecharger Rapport</a>
                                </td>
                            </tr>
                        })}
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>)
    }
}
