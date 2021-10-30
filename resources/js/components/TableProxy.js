import React from "react";
import { Component } from "react";
import { FILTERS } from "./PublicMap";
import ObservationsGovernorateTable from "./Tables/ObservationsGovernorateTable";
import ReportGovernorateTable from "./Tables/ReportGovernorateTable";

export default class TableProxy extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        const { filter, governorate, establishment } = this.props
        if (filter === FILTERS.OBSERVATIONS) {
            return <ObservationsGovernorateTable establishment={establishment} governorate={governorate} />
        }else if (filter === FILTERS.REPORTS) {
            return <ReportGovernorateTable governorate={governorate} establishment={establishment} />
        }
    }

}
