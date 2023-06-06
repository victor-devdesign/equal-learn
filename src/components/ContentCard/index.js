//-- Default import
import React from 'react';

//-- Styles of Page
import './style.css'

export const ContentCard = (props) => {

    return (
        <div className='card content-card'>
            <div className='card-body'>
                <img src={props.img} className='card-img-top' alt={props.title} />
            </div>
            <div className='card-footer'>
                <h5 className='card-title'>{props.title}</h5>
                <p className='card-text'>{props.content}</p>
            </div>
        </div>
    )
}