import React from 'react';
import ReactDom from 'react-dom';
import axios from "axios";
import Loader from "./Loader";
import Governorate from "./Governorate";
import FaultChart from "./Charts/FaultChart";
import FinancialImpact from "./Charts/FinancialImpact";
import TableProxy from "./TableProxy";
import ReportSectorTable from "./Tables/ReportSectorTable";

const FILTERS = {
    REPORTS: 'reports',
    OBSERVATIONS: 'observations'
}
export { FILTERS };

class PublicMap extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            isLoading: true,
            governorates: [],
            rooms: [],
            establishments: [],
            establishment: null,
            filter: FILTERS.REPORTS,
            governorate: null,
            sectors: [],
            sector: null,
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
        axios.get('/api/sector')
            .then(response => {
                this.setState({
                    sectors: response.data
                })
            })
            .catch(err => {
                alert(err)
            })
    }

    handleClick(event, governorate) {

        this.setState({
            establishment: null
        })

        axios.get('api/governorate/'+governorate)
            .then(response => {
                this.setState({
                    governorate: response.data
                })
            }).catch(err => {
                alert(err)
            })

        axios.get('api/governorate/'+governorate+'/establishment')
            .then(response => {
                this.setState({
                    establishments: response.data
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

    handleEstablishmentChange(event, governorate, establishment) {
        event.preventDefault()
        axios.get('api/governorate/'+governorate.id)
            .then(response => {
                this.setState({
                    governorate: response.data
                })
            }).catch(err => {
            alert(err)
        })

        axios.get('api/establishment/show/'+establishment)
            .then(response => {
                this.setState({
                    establishment: response.data
                })
            }).catch(err => {
            alert(err)
        })

    }

    render() {
        const {isLoading, sectors, governorates, governorate, rooms, sector, filter, establishments, establishment} = this.state

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }
        let reportTableKey = null;
        if (sector) {
            reportTableKey = sector.id
            if (governorate) {
                reportTableKey = sector.id + governorate.id
            }
        }

        return (<div className={'container-fluid'}>
            <div className={"row"}>
                <div className="col-md-4">
                    <div className={'card'}>
                        <div className={'card-header'}>
                            Map Tunisia
                            <div className="dropdown float-right">
                                <button className="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button"
                                        id="list-sectors" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> Sectors
                                </button>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="list-sectors">
                                    {sectors.map(sector => <a key={sector.id} className="dropdown-item small text-muted" href="#" onClick={() => this.setState({sector: sector, governorate: null})}>{sector.name}</a>)}
                                </div>
                            </div>

                            <div className="dropdown float-right">
                                <button className="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button"
                                        id="list-rooms" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"> Rooms
                                </button>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="list-rooms">
                                    <a className="dropdown-item small text-muted" href="#" onClick={(e) => this.reloadGovernorates(e)}>All</a>
                                    {rooms.map(room => <a key={room.id} className="dropdown-item small text-muted" href="#" onClick={() => this.selectGovernoratesPerRoom(room)}>{room.name}</a>)}
                                </div>
                            </div>

                            <div className="dropdown float-right">
                                {governorate ? <>
                                    <button className="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button"
                                            id="list-establishment" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"> Establishments
                                    </button>
                                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="list-establishment">
                                        {establishments.map(estb => <a key={estb.id} href="#" className="dropdown-item small text-muted" onClick={(e) => this.handleEstablishmentChange(e, governorate, estb.id)}>{estb.name}</a>)}
                                    </div>
                                </> : null}
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
                <div className={'col-md-6'}>
                    <div className="row">
                        <div className="col-md-8">
                            <ReportSectorTable governorate={governorate} sector={sector} key={reportTableKey} />
                        </div>
                    </div>
                </div>
                <div className="col-md-2">
                    <div className="row">
                        <div className="col-md-12">
                            <h4>Chart 1</h4>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <h4>Chart 1</h4>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <h4>Chart 1</h4>
                        </div>
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
