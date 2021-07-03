import React from "react";


export default class Governorate extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        let { coord, id, title, clickHandler } = this.props
        return ( <path id={id} title={title} d={ coord } onClick={e => clickHandler(e, id)} /> );
    }
}
