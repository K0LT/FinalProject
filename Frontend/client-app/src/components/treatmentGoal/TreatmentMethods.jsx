import React from 'react';

function TreatmentMethods(props) {
    return (
        <div style={{ marginBottom: '12px' }}>
            <h4 style={{ fontSize: '14px' }}>Treatment Methods</h4>
            <div style={{ display: 'flex', gap: '4px', flexWrap: 'wrap' }}>
                {props.methods.map((m, i) => (
                    <span key={i} style={{ fontSize: '12px', padding: '2px 6px', borderRadius: '4px', backgroundColor: '#eee' }}>
                        {m}
                    </span>
                ))}
            </div>
        </div>
    );
}

export default TreatmentMethods;