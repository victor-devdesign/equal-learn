//-- Default import
import React from 'react';

//-- Styles of Page
import './style.css'

function LoggedHome(options) {

    const data = options.data;

    return (
        <div>
            <div className='row'>
                <div className='col-12'>
                    <h1>This is the Logged Home</h1>
                </div>
            </div>
        </div>
    );
}

export default LoggedHome;