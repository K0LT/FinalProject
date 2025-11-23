import React from 'react';

function Badge(props) {
    const bg = props.variant === 'destructive' ? 'red' : props.variant === 'primary' ? 'blue' : 'gray';
    const color = props.variant === 'destructive' ? 'white' : 'black';
    return (
        <span style={{ padding: '2px 6px', fontSize: '12px', borderRadius: '4px', backgroundColor: bg, color: color }}>
            {props.label}
        </span>
    );
}

export default Badge;