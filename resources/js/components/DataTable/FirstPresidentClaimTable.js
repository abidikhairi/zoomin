import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import $ from 'jquery';
import he from 'he';
import Loader from "../Loader";
import ClaimEntry from "./ClaimEntry";


class FirstPresidentClaimTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            claims: null,
            isLoading: true,
            roomPresident: null,
            chart: 'establishment',
        }
        this.loadClaims = this.loadClaims.bind(this)
    }

    loadClaimsByEstablishments(e) {
        e.preventDefault()
        this.setState({
            isLoading: true
        })

        axios.get('/zoomin/api/first-president/claim/establishment/')
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
        axios.get('/zoomin/api/first-president/claim/sector/')
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


    loadClaims(e) {
        e.preventDefault()
        this.setState({
            isLoading: false,
        })
        let president_id = $('#claim-table-app').data('room-president')
        axios.get('/zoomin/api/first-president/claim/')
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
        axios.get('/zoomin/api/first-president/claim/citizen/priority/')
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
        axios.get('/zoomin/api/first-president/claim/')
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
        const {isLoading, claims} = this.state

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }
        return (<div className={'row justify-content-center'}>
            <div className={'col-md-8'}>
                <div className="card shadow">
                    <div className="card-header">
                        <div className="row d-flex justify-content-between">
                            <div className="col-md-3">
                                <h2 className="h4 mb-1"> الشكاوي</h2>
                            </div>
                            <div className="col-md-6">
                                <button className="btn btn-primary mr-2 d-inline" type="button" onClick={(e) => this.loadClaims(e)}> امسح
                                </button>
                                <div className="dropdown d-inline">
                                    <button className="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> فلتر
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
                                <th>الصفة</th>
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
        </div>)
    }
}

if (document.getElementById('fp-claim-table-app')) {
    ReactDOM.render(<FirstPresidentClaimTable />, document.getElementById('fp-claim-table-app'))
}
