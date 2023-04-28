import { useState, useEffect } from 'react';
import { NavBar } from './components/NavBar/index.js';
import { Carrousel } from './components/Carrousel/index.js';
import { Loader } from './components/Loader/index.js';

const API_URL = "http://localhost/equal-learn/public/Api/";

function getData() {
  // return fetch(API_URL + "MetaTags/getMetaTags").then((response) => response.json());
  console.log("Load Api");
  return {
    url: document.location.origin + "/",
    logo: {
      small: document.location.origin + "/assets/img/logo/small_logo.png",
      medium: document.location.origin + "/assets/img/logo/medium_logo.png",
      large: document.location.origin + "/assets/img/logo/large_logo.png",
    },
    metas: {},
    user: {
      // id: "1",
      // name: "Cléber da Costa",
      // role: "free_user",
      // profile: document.location.origin + "/assets/img/avatar.jpg",
      // roles: {},
    },
  };
}

export const App = () => {

  const [data, setData] = useState(null);

  useEffect(() => {
    setData(getData());
  }, []);

  if (data === null) {
    return (
      <div>
        <Loader />
      </div>
    );
  }

  return (
    <div className="row">
      <div className="col-12">
        <NavBar logo={data.logo.small} profile={data.user.profile} name={data.user.name} />
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