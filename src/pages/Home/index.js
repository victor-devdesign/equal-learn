import React from 'react';
import { Carrousel } from '../../components/Carrousel/index.js';

function Home(options) {

    const data = options.data;

    return (
        <div>
            <Carrousel url={data.url} />
            <h1>this is the homepage</h1>
        </div>
    );
}

export default Home;