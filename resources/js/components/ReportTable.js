import React from 'react';

export default class ReportTable extends React.Component {

    constructor(props) {
        super(props);
    }

    downloadReport(event, report) {
        console.log(report)
    }

    render() {
        let {reports} = this.props
        return (<div className="card">
            <div className="card-header"><i className="fa fa-align-justify"/> Last 4 Reports</div>
            <div className="card-body">
                <table className="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sector</th>
                        <th>Establishment</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {reports.map(report => {
                        return (<tr key={report.id}>
                            <td>{report.title}</td>
                            <td>{report.sector.name}</td>
                            <td>{report.establishment.name}</td>
                            <td>
                                <button className={'btn btn-xs btn-flat btn-success'} onClick={e => this.downloadReport(e, report.id)}>Download</button>
                            </td>
                        </tr>)
                    })}
                    </tbody>
                </table>
            </div>
        </div>);
    }
}
