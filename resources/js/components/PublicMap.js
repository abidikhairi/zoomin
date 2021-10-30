import React from 'react';
import ReactDom from 'react-dom';
import axios from "axios";
import Loader from "./Loader";
import Governorate from "./Governorate";
import ReportTable from "./ReportTable";
import FaultChart from "./Charts/FaultChart";
import FinancialImpact from "./Charts/FinancialImpact";

const FILTERS = {
    REPORTS: 'reports',
    OBSERVATIONS: 'observations'
}

class PublicMap extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            isLoading: true,
            governorates: [],
            rooms: [],
            reports: [],
            filter: FILTERS.REPORTS,
            governorate: null
        }
    }

    componentDidMount() {
        axios.get('/api/governorate')
            .then(response => {
                this.setState({
                    isLoading: false,
                    governorates: response.data
                });
            }).catch(err => {
            alert(err)
        })
        axios.get('/api/room')
            .then(response => {
                this.setState({
                    rooms: response.data
                })
            })
            .catch(err => {
                alert(err)
            })
        axios.get('/api/report')
            .then(response => {
                this.setState({
                    reports: response.data
                })
            }).catch(err => {
                alert(err)
            })
    }

    handleClick(event, governorate) {
        axios.get('api/governorate/'+governorate)
            .then(response => {
                this.setState({
                    governorate: response.data
                })
            }).catch(err => {
                alert(err)
            })
    }

    selectGovernoratesPerRoom(room) {
        let room_id = room.id
        let { governorates } = this.state
        let ngovs = governorates.filter(gov => gov.room_id === room_id)

        this.setState({
            governorates: ngovs
        })
    }

    render() {
        const {isLoading, reports, governorates, governorate, rooms, filter} = this.state

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }

        return (<div className={'container-fluid'}>
            <div className={"row justify-content-between"}>
                <div className="col-md-4">
                    <div className={'card'}>
                        <div className={'card-header'}>
                            Map Tunisia
                            <div className="dropdown float-right">
                                <button className="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button"
                                        id="rangeDropdown" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> Rooms
                                </button>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="rangeDropdown">
                                    <a className="dropdown-item small text-muted" href="#" onClick={(e) => this.reloadGovernorates(e)}>All</a>
                                    {rooms.map(room => <a key={room.id} className="dropdown-item small text-muted" href="#" onClick={(e) => this.selectGovernoratesPerRoom(room)}>{room.name}</a>)}
                                </div>
                            </div>
                        </div>
                        <div className={'card-body justify-content-center'}>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 200 440">
                                <g transform="scale(0.70)">
                                    { governorates.map(gov => <Governorate key={gov.id} id={gov.id} title={gov.name} coord={gov.svg_coord} clickHandler={this.handleClick.bind(this)} room={gov.room_id} />)}
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div className={'col-md-8'}>
                    <div className={"row"}>
                        { governorate ?
                            <div className={'col-md-6'}>
                                <FinancialImpact governorate={governorate} />
                            </div>:  <Loader kind={'progress'} color={'warning'} styles={{width: '15rem', height: '15rem'}} />
                        }
                        { reports ?
                            <div className={'col-md-6'}>
                                <div className={'card'}>
                                    <div className="card-header">Choose Filter</div>
                                    <div className={'card-body'}>
                                        <div className={'form-group'}>
                                            <div className="custom-control custom-radio">
                                                <input type="radio" id="filter-reports" name="filter-reports"
                                                       className="custom-control-input" checked={filter === FILTERS.REPORTS} onChange={() => this.setState({filter: FILTERS.REPORTS}) } />
                                                    <label className="custom-control-label" htmlFor="filter-reports">
                                                        { FILTERS.REPORTS }
                                                    </label>
                                            </div>
                                            <div className="custom-control custom-radio">
                                                <input type="radio" id="filter-observations" name="filter-observations"
                                                       className="custom-control-input" checked={filter === FILTERS.OBSERVATIONS} onChange={() => this.setState({filter: FILTERS.OBSERVATIONS})} />
                                                <label className="custom-control-label" htmlFor="filter-observations">
                                                    { FILTERS.OBSERVATIONS }
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>: <Loader kind={'progress'} color={'warning'} styles={{width: '15rem', height: '15rem'}} />
                        }
                        { governorate ?
                            <div className={'col-md-6'}>
                                <FaultChart governorate={governorate}/>
                            </div>: <Loader kind={'progress'} color={'success'} styles={{width: '15rem', height: '15rem'}} />
                        }
                    </div>
                </div>
            </div>
        </div>);
    }

    reloadGovernorates(e) {
        e.preventDefault();
        axios.get('/api/governorate')
            .then(response => {
                this.setState({
                    governorates: response.data
                });
            }).catch(err => {
            alert(err)
        })
    }
}

export default PublicMap;


if (document.getElementById('public-map-app')) {
    ReactDom.render(<PublicMap />, document.getElementById('public-map-app'))
}
