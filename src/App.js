import { NavBar } from './components/NavBar/index.js';

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
            <button className="btn btn-client-primary">TESTE</button>
          </div>
        </main>
      </div>
    </div>
  );
}
