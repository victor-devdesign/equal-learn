//-- Default import
import React from 'react';
import { useState, useEffect } from 'react';

//-- Components import
import { ContentCard } from '../../components/ContentCard';

//-- Styles of Page
import './style.css'

function CardsMap(props) {
    const contents = props.data.map((card) =>
        <div className='col-12 col-md-3 mb-4' key={card.id}>
            <ContentCard img={card.img} title={card.title} content={card.content} />
        </div>
    );

    return (
        <div className='row'>
            {contents}
        </div>
    );
}

function getCourses() {
    let test = 'teste';
    return fetch('./assets/test/courses/' + test + '.json', {
        headers: {
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        .then((data) => { return data; })
        .catch((error) => {
            console.error(error);
        });
}

function LoggedHome(options) {

    const [courses, setData] = useState([]);

    useEffect(() => {
        getCourses().then((data) => setData(data));
    }, []);

    return (
        <div>
            <div className='row'>
                <div className='col-12 mb-4'>
                    <h1>Equal Learning Studio</h1>
                </div>
            </div>
            <CardsMap data={courses} />
        </div>
    );
}

export default LoggedHome;