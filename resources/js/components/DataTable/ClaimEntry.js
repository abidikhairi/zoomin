import React, { Component } from 'react';
import MagistrateAssignForm from "../Modals/MagistrateAssignForm";

class ClaimEntry extends Component {
    constructor(props) {
        super(props);
        this.state = {
            show: false
        }
        this.showModal = this.showModal.bind(this);
        this.hideModal = this.hideModal.bind(this);
        this.archiveClaim = this.archiveClaim.bind(this)
    }

    archiveClaim(e) {
        e.preventDefault()
        const { claim, reloadClaimFunc } = this.props
        axios.post('/api/room-president/claim/archive', {
            claim_id: claim.id
        }).then(response => {
            alert(response.data.message)
        }).catch(err => {
            alert(err)
        })
        reloadClaimFunc(e)
    }

    showModal() {
        this.setState({ show: true });
    };

    hideModal() {
        this.setState({ show: false });
    };

    render() {
        const { show } = this.state
        let { claim, reloadClaimFunc } = this.props
        let statusCell = <span className="badge badge-warning">Pending</span>
        if (claim.status === 'accepted') {
            statusCell = <span className="badge badge-success">Accepted</span>
        }else if (claim.status === 'rejected') {
            statusCell = <span className="badge badge-danger">Rejected</span>
        }
        return (
            <tr>
                <td>{ claim.citizen.user.email }</td>
                <td>{ claim.citizen.profile.name }</td>
                <td>{ claim.sector.name }</td>
                <td>{ claim.establishment.name }</td>
                <td>{ claim.governorate.name }</td>
                <td>{ claim.claim_type.name }</td>
                <td>
                    { statusCell }
                </td>
                <td>
                    <button className="btn btn-sm dropdown-toggle more-horizontal" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span className="text-muted sr-only">Action</span>
                    </button>
                    <div className="dropdown-menu dropdown-menu-right">
                        <a className="dropdown-item" href="#" onClick={this.archiveClaim}>Archive</a>
                        <a className="dropdown-item assign-claim" onClick={this.showModal} href="#">Assign</a>
                        { show === true ? <MagistrateAssignForm reloadClaimFunc={reloadClaimFunc} claim={claim} show={show} hideModal={this.hideModal} />: null }
                    </div>
                </td>
            </tr>);
    }
}

export default ClaimEntry;
