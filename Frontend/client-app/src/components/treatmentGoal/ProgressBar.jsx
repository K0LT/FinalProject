import React from 'react';

function ProgressBar(props) {
    return (
        <div style={{ backgroundColor: '#eee', height: '8px', borderRadius: '4px', overflow: 'hidden', marginBottom: '12px' }}>
            <div style={{ width: `${props.progress}%`, height: '100%', backgroundColor: 'blue' }}></div>
        </div>
    );
}

export default ProgressBar;