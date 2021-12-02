import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import Governorate from './Governorate';
import Loader from "./Loader";
import GovernorateChart from "./Charts/GovernorateChart";

class Map extends React.Component {

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
                let claims = response.data.claims
                let governorate = response.data.governorate
                this.setState({
                    governorate: {
                        claims: claims,
                        governorate: governorate
                    }
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

        return (<div className={"row justify-content-between"}>
            <div className="col-md-5">
                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 283 593">
                    <g transform="scale(0.90)">
                        { governorates.map(gov => <Governorate key={gov.id} id={gov.id} title={gov.name} coord={gov.svg_coord} clickHandler={this.handleClick.bind(this)} />)}
                    </g>
                </svg>
            </div>
            { governorate ? (<div className="col-md-7">
                    <div className={'row'}>
                        <div className={'col-md-12'}>
                            <GovernorateChart governorate={governorate.governorate} />
                        </div>
                    </div>
                </div>) : null }
        </div>);
    }
}

export default Map;

if (document.getElementById('map-app')) {
    ReactDOM.render(<Map />, document.getElementById('map-app'));
}
