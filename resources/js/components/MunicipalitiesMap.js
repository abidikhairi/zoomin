import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import Loader from "./Loader";
import Governorate from "./Governorate";
import MunicipalitiesLineCharts from "./Charts/MunicipalitiesLineCharts";
import RankTable from "./Tables/RankTable";
import ObservationPerGovernorate from "./Charts/ObservationPerGovernorate";

class MunicipalitiesMap extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isLoading: true,
            governorates: [],
            governorate: null,
        }
    }

    componentDidMount() {
        axios.get('/zoomin/api/governorate')
            .then(response => {
                this.setState({
                    isLoading: false,
                    governorates: response.data
                });
            }).catch(err => {
            alert(err)
        })
    }

    handleClick(event, governorate) {
        const endpoint = '/zoomin/api/claim/{governorate}'.replace('{governorate}', governorate)
        axios.get(endpoint)
            .then(response => {
                let governorate = response.data.governorate
                this.setState({
                    governorate: governorate
                })
            })
            .catch(err => {
                alert(err)
            })
    }

    render() {
        const {isLoading, governorates, governorate} = this.state
        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }
        return (<div className={"row justify-content-around"}>
            <div className="col-md-4">
                <div className="card">
                    <div className="card-header">
                        التوزيع الجغرافي للملاحظات
                    </div>
                    <div className="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 283 593">
                            <g transform="scale(0.85)">
                                { governorates.map(gov => <Governorate key={gov.id} id={gov.id} title={gov.name} coord={gov.svg_coord} clickHandler={this.handleClick.bind(this)} />)}
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <div className="col-md-8">
                <div className={'row'}>
                    <div className={'col-md-12'}>
                        { governorate ? <MunicipalitiesLineCharts governorate={governorate} /> : null }
                    </div>
                </div>
                <div className="row mt-3">
                    <div className="col-md-6">
                        <RankTable />
                    </div>
                    <div className="col-md-6">
                        { governorate ? <ObservationPerGovernorate governorate={governorate} /> : null }
                    </div>
                </div>
            </div>
        </div>);
    }
}

export default MunicipalitiesMap;

if (document.getElementById('municipalities-map-app')) {
    ReactDOM.render(<MunicipalitiesMap />, document.getElementById('municipalities-map-app'));
}
