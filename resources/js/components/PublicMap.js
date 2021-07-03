import React from 'react';
import ReactDom from 'react-dom';
import axios from "axios";
import Loader from "./Loader";
import Governorate from "./Governorate";
import ReportTable from "./ReportTable";
import FaultChart from "./Charts/FaultChart";
import FinancialImpact from "./Charts/FinancialImpact";

class PublicMap extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            isLoading: true,
            governorates: [],
            reports: [],
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
        axios.get('/api/report')
            .then(response => {
                console.log(response.data)
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

    render() {
        const {isLoading, reports, governorates, governorate} = this.state

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }

        return (<div className={'container-fluid'}>
            <div className={"row justify-content-between"}>
                <div className="col-md-4">
                    <div className={'card'}>
                        <div className={'card-header'}>
                            Map Tunisia
                        </div>
                        <div className={'card-body justify-content-center'}>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 200 440">
                                <g transform="scale(0.70)">
                                    { governorates.map(gov => <Governorate key={gov.id} id={gov.id} title={gov.name} coord={gov.svg_coord} clickHandler={this.handleClick.bind(this)} />)}
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
                                <ReportTable reports={reports}/>
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
}

export default PublicMap;


if (document.getElementById('public-map-app')) {
    ReactDom.render(<PublicMap />, document.getElementById('public-map-app'))
}
