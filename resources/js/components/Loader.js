import React from 'react';

export default function Loader(props) {
    const { kind, color, styles } = props
    return (<div className="text-center">
        <div className={`spinner-${kind} text-${color}`} style={styles} role="status">
            <span className="sr-only">Loading...</span>
        </div>
    </div>);
}
