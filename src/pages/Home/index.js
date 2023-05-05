//-- Default import
import React from 'react';

//-- Components import
import { Carrousel } from '../../components/Carrousel';

//-- Icons
import { GiInjustice } from "react-icons/gi";
import { ImBooks } from "react-icons/im";
import { FaPeopleCarry, FaBrain, FaPencilAlt } from "react-icons/fa";
import { MdWork } from "react-icons/md";

//-- Styles of Page
import './style.css'

function Home(options) {

    const data = options.data;

    return (
        <div>
            <div className='row'>
                <div className='col-12'>
                    <Carrousel url={data.url} />
                </div>
            </div>

            <div className='row display-card'>
                <div className='col-6'>
                    <h1>Quem Somos?</h1>
                    <p>Somos uma empresa que tem como missão construir um futuro mais justo, através da educação.
                        Acreditamos que a educação é a chave para o desenvolvimento de qualquer país, e que o acesso a ela deve ser democrático.</p>
                </div>
                <div className='col-8'>
                    <div className='row'>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content justice">
                                <GiInjustice />
                                <h5>Educação para Justiça Social</h5>
                                <p>Construir um futuro mais justo, através da educação.</p>
                            </div>
                        </div>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content books-study">
                                <ImBooks />
                                <h5>Integração Ensino Básico-Superior</h5>
                                <p>Quebrar barreiras entre o ensino superior e o básico</p>
                            </div>
                        </div>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content people-carry">
                                <FaPeopleCarry />
                                <h5>Estímulo à Colaboração</h5>
                                <p>Estimular a colaboração entre pessoas</p>
                            </div>
                        </div>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content brain">
                                <FaBrain />
                                <h5>Compartilhamento de Conhecimento</h5>
                                <p>Compartilhar conhecimento e adquirir experiência</p>
                            </div>
                        </div>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content pencil-art">
                                <FaPencilAlt />
                                <h5>Oportunidades para Ensino Básico</h5>
                                <p>Dar mais oportunidade para alunos do ensino básico</p>
                            </div>
                        </div>
                        <div className='col-12 col-md-4 mb-4'>
                            <div className="card mission-content work-bag">
                                <MdWork />
                                <h5>Mercado de Trabalho</h5>
                                <p>Auxiliar o jovem universitário a entrar no mercado de trabalho</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Home;