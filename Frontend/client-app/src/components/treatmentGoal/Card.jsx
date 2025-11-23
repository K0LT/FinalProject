import React from 'react';
import CardHeader from './CardHeader';
import ProgressBar from './ProgressBar';
import TreatmentMethods from './TreatmentMethods';
import Milestones from './Milestones';

function Card(props) {
    return (
        <div style={{ border: '1px solid #ccc', borderRadius: '8px', overflow: 'hidden', width: '1750px' }}>
            <CardHeader title={props.title} description={props.description} badges={props.badges} targetDate={props.targetDate} />
            <div style={{ padding: '16px' }}>
                <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '4px' }}>
                    <span>Progress</span>
                    <span>{props.progress}%</span>
                </div>
                <ProgressBar progress={props.progress} />
                <TreatmentMethods methods={props.treatmentMethods} />
                <Milestones items={props.milestones} />
            </div>
        </div>
    );
}

export default Card;