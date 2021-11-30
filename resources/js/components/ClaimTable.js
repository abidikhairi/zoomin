import React from 'react';

export default function (props) {
    let { claims, governorate } = props

    return (<div className="card">
                <div className="card-header">
                    <i className="fa fa-align-justify"/>Claims: {governorate.name}</div>
                <div className="card-body">
                    <table className="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th>الموضوع</th>
                                <th> التاريخ</th>
                                <th> القطاع</th>
                                <th> المؤسسة</th>
                            </tr>
                        </thead>
                        <tbody>
                            { claims.map(claim => {
                                return (<tr key={claim.id}>
                                    <td>{ claim.subject }</td>
                                    <td>{ claim.created_at }</td>
                                    <td>{ claim.sector.name }</td>
                                    <td>{ claim.establishment.name }</td>
                                </tr>);
                            }) }
                        </tbody>
                    </table>
                </div>
            </div>);
}
