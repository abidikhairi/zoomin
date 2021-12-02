import React from "react";
import $ from 'jquery';

export default class Governorate extends React.Component {

    constructor(props) {
        super(props);
    }

    handleFocusEvent(e, id) {
        axios.get('/api/report/governorate/'+id)
            .then(response => {
                $(e.target).tooltip({
                    title: response.data.join("<br/>"),
                });
            }).catch(err => {
                alert(err)
            })
    }

    render() {
        let { coord, id, title, clickHandler, room } = this.props
        return ( <path id={id}  data-html={"true"} d={ coord } onClick={e => clickHandler(e, id)} data-room={room} onMouseEnter={(e) => this.handleFocusEvent(e, id)}/> );
    }
}
