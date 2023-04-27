import { useState, useEffect } from 'react';
import { NavBar } from './components/NavBar/index.js';
import { Carrousel } from './components/Carrousel/index.js';
import { Loader } from './components/Loader/index.js';

const API_URL = "http://localhost/equal-learn/public/Api/";

function getData() {
  return fetch(API_URL + "MetaTags/getMetaTags").then((response) => response.json());
}

export const App = () => {

  const [data, setData] = useState(null);

  useEffect(() => {
    getData().then((responseData) => setData(responseData)).catch((error) => console.error(error));
  }, []);

  if (!data) {
    setInterval(() => {
      //-- Call the API each 15 seconds
      getData().then((responseData) => setData(responseData)).catch((error) => console.error(error));
    }, 15000);

    return (
      <div>
        <Loader />
      </div>
    );
  }

  return (
    <div className="row">
      <div className="col-12">
        <NavBar url={data.url} profileUrl="assets/img/avatar.jpg" profileName="Cléber da Costa" />
      </div>
      <div className="col-12">
        <main>
          <div className="container">
            <div className="card">
              <div className="card-body">
                <Carrousel url={data.url} />
                <h5 className="card-title">Título do card</h5>
                <p className="card-text">Texto do card</p>
                <a href="#" className="btn btn-primary">Ir para algum lugar</a>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  );
};