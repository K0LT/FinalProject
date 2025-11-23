import React from 'react';
import Badge from './Badge';

function CardHeader(props) {
    return (
        <div style={{ display: 'flex', justifyContent: 'space-between', padding: '16px', borderBottom: '1px solid #eee' }}>
            <div>
                <h4>{props.title}</h4>
                <p style={{ color: '#666' }}>{props.description}</p>
            </div>
            <div style={{ textAlign: 'right' }}>
                <div style={{ display: 'flex', gap: '4px', justifyContent: 'flex-end' }}>
                    {props.badges.map((b, i) => <Badge key={i} label={b.label} variant={b.variant} />)}
                </div>
                <div style={{ fontSize: '12px', color: '#666', marginTop: '4px' }}>
                    Target: {props.targetDate}
                </div>
            </div>
        </div>
    );
}

export default CardHeader;