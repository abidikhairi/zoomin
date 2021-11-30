import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import $ from 'jquery';
import he from 'he';
import Loader from "../Loader";
import ClaimEntry from "./ClaimEntry";
import ClaimsByProfileChart from "../Charts/ClaimsByProfileChart";
import ClaimsByEstablishmentsChart from "../Charts/ClaimsByEstablishmentsChart";
import ClaimsBySectorsChart from "../Charts/ClaimsBySectorsChart";
import ClaimsByTypesChart from "../Charts/ClaimsByTypesChart";


class ClaimTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            claims: null,
            isLoading: true,
            roomPresident: null,
            chart: 'establishment',
            claimTypes: null
        }
        this.loadClaims = this.loadClaims.bind(this)
    }

    loadClaimsByEstablishments(e) {
        e.preventDefault()
        this.setState({
            isLoading: true
        })
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/establishment/'+president_id)
            .then(response => {
                console.log(response.data)
                let { claims } = response.data
                this.setState({
                    claims: claims,
                    isLoading: false,
                    chart: 'establishment'
                })
            }).catch(err => {
            alert(err)
        })
    }

    loadClaimsBySectors(e) {
        e.preventDefault()
        this.setState({
            isLoading: true
        })
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/sector/'+president_id)
            .then(response => {
                let { claims } = response.data
                this.setState({
                    claims: claims,
                    isLoading: false,
                    chart: 'sector'
                })
            }).catch(err => {
            alert(err)
        })
    }

    loadClaimsByType(e, type = '') {
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/'+president_id+'/type?type='+type)
            .then(response => {
                const { claims } = response.data
                this.setState({
                    claims: claims,
                    chart: 'type'
                })
            }).catch(err => {
            alert(err)
        })
    }

    loadClaims(e) {
        e.preventDefault()
        this.setState({
            isLoading: false,
        })
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/'+president_id)
            .then(response => {
                let { claims, roomPresident } = response.data
                this.setState({
                    claims: claims,
                    isLoading: false,
                    roomPresident: roomPresident,
                })
            }).catch(err => {
            alert(err)
        })
    }

    loadClaimsOrderedByCitizenProfile(e) {
        e.preventDefault()
        this.setState({
            isLoading: true,
        })
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/citizen/priority/'+president_id)
            .then(response => {
                let { claims} = response.data
                this.setState({
                    claims: claims,
                    isLoading: false,
                    chart: 'citizen'
                })
            }).catch(err => {
                alert(err)
            })
    }

    componentDidMount() {
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/api/room-president/claim/'+president_id)
            .then(response => {
                let { claims, roomPresident, claimTypes } = response.data
                this.setState({
                    claims: claims,
                    isLoading: false,
                    roomPresident: roomPresident,
                    claimTypes: claimTypes
                })
            }).catch(err => {
                alert(err)
            })
    }

    handlePageChange(link) {
        this.setState({
            isLoading: true
        })
        axios.get(link.url)
            .then(response => {
                this.setState({
                    claims: response.data.claims,
                    isLoading: false
                })
            })
            .catch(err => {
                alert(err)
            })
    }

    render() {
        const {isLoading, claims, roomPresident, chart, claimTypes} = this.state
        let room_president_id = $('#claim-table-app').data('room-president');

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }
        return (<div className={'row justify-content-center'}>
            <div className={'col-md-8'}>
                <div className="card shadow">
                    <div className="card-header">
                        <div className="row d-flex justify-content-between">
                            <div className="col-md-3">
                                <h2 className="h4 mb-1"> الشكاوي: {roomPresident.room.name}</h2>
                            </div>
                            <div className="col-md-6">
                                <button className="btn btn-primary mr-2 d-inline" type="button" onClick={(e) => this.loadClaims(e)}> Clear
                                </button>
                                <div className="dropdown d-inline">
                                    <button className="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Filters
                                    </button>
                                    <div className="dropdown-menu" aria-labelledby="actionMenuButton">
                                        <a className="dropdown-item" href="#" role={'button'} onClick={(e) => this.loadClaimsOrderedByCitizenProfile(e)}>
                                            المواطن
                                        </a>
                                        <a className="dropdown-item" href="#" role={'button'} onClick={(e) => this.loadClaimsByEstablishments(e)}>
                                            المؤسسة
                                        </a>
                                        <a className="dropdown-item" href="#" role={'button'} onClick={(e) => this.loadClaimsBySectors(e)}>
                                            القطاع
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="card-body">
                        <table className="table table-bordered">
                            <thead>
                            <tr role="row">
                                <th colSpan="2">المواطن</th>
                                <th colSpan="3">المؤسسة</th>
                                <th colSpan="3">الشكوى</th>
                            </tr>
                            <tr role="row">
                                <th>البريد الالكتروني</th>
                                <th>Profile</th>
                                <th>القطاع</th>
                                <th>المؤسسة</th>
                                <th>الولاية</th>
                                <th>الحالة</th>
                                <th>أجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            { claims.data.map(claim => {
                                return <ClaimEntry reloadClaimFunc={this.loadClaims} claim={claim} key={claim.id} />
                            }) }
                            </tbody>
                        </table>
                        <nav aria-label="Table Paging" className="mb-0 text-muted">
                            <ul className="pagination justify-content-end mb-0">
                                {claims.links.map((link, index) => {
                                    return <li key={index} className={'page-item mr-2 ' + (link.active ? 'active' : '')}>
                                        <a className={'page-link'} href="#" onClick={() => this.handlePageChange(link)} >{he.decode(link.label)}</a>
                                    </li>
                                })}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div className={'col-md-4'}>
                {chart === 'type' ? <ClaimsByTypesChart roomPresident={room_president_id} /> : null }
                {chart === 'citizen' ? <ClaimsByProfileChart roomPresident={room_president_id} />: null}
                {chart === 'establishment' ? <ClaimsByEstablishmentsChart roomPresident={room_president_id} />: null}
                {chart === 'sector' ? <ClaimsBySectorsChart roomPresident={room_president_id} />: null}
            </div>
        </div>)
    }
}

if (document.getElementById('claim-table-app')) {
    ReactDOM.render(<ClaimTable />, document.getElementById('claim-table-app'))
}
