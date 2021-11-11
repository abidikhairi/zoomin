import React, { Component } from 'react';
import Loader from "../Loader";


export default class RankTable extends Component {
    constructor(props) {
        super(props);
        this.state = {
            items: [],
            isLoading: false
        }
    }

    componentDidMount() {
        axios.get('/api/observation/rank')
            .then(response => {
                this.setState({
                    items: response.data,
                    isLoading: false
                })
            }).catch(err => {
                alert(err)
            })
    }

    render() {
        let {items, isLoading} = this.state

        if (isLoading === true) {
            return (<Loader kind={'grow'} color={'primary'} styles={{width: '20rem', height: '20rem'}} />);
        }

        return <div className={'card'}>
            <div className="card-header">
                Municipalities Rank By # Observations
            </div>
            <div className="card-body">
                <table className={'table'}>
                    <thead>
                        <tr>
                            <th>Governorate</th>
                            <th>Municipality</th>
                            <th># Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        { items.map((item, index) => {
                            return <tr index={index} key={index}>
                                <td>{item.governorate}</td>
                                <td>{item.name}</td>
                                <td>{item.observations}</td>
                            </tr>
                        })}
                    </tbody>
                </table>
            </div>
        </div>
    }
}
