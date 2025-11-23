import React from 'react';

function Milestones(props) {
    return (
        <div>
            <h4 style={{ fontSize: '14px', marginBottom: '4px' }}>Milestones</h4>
            <div style={{ display: 'flex', flexDirection: 'column', gap: '6px' }}>
                {props.items.map((m, i) => (
                    <div key={i} style={{ display: 'flex', alignItems: 'flex-start', gap: '8px' }}>
                        <div style={{
                            width: '12px',
                            height: '12px',
                            borderRadius: '50%',
                            backgroundColor: m.completed ? 'green' : '#ccc',
                            marginTop: '4px'
                        }}></div>
                        <div style={{ flex: 1, display: 'flex', justifyContent: 'space-between' }}>
                            <span style={{ fontSize: '12px', color: m.completed ? 'black' : '#666' }}>{m.title}</span>
                            <span style={{ fontSize: '12px', color: '#666' }}>{m.date}</span>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default Milestones;
