import { NavBar } from './components/NavBar/index.js';
import { Carrousel } from './components/Carrousel/index.js';

export const App = () => {

  const route = 'http://localhost:3000/';

  return (
    <div className="row">
      <div className="col-12">

        <NavBar url={route} profileUrl="assets/img/avatar.jpg" profileName="Cléber da Costa" />

      </div>
      <div className="col-12">
        <main>
          <div className="container">
            <div className="card">
              <div className="card-body">

                <Carrousel url={route} />

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
}
