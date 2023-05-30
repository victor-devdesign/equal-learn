import React from 'react';

function Members() {

    const members = {
        'henrique': {
            nome: 'Henrique Brenner Alves Matias',
            ra: '822160817',
            email: 'henriquematias.0817@aluno.saojudas.br',
            img: '/henrique',
        },
        'jose': {
            nome: 'José Iran Barbosa Fernandes Junior',
            ra: '822163632',
            email: 'josejunior.3632@aluno.saojudas.br',
            img: '/jose',
        },
        'nathan': {
            nome: 'Nathan Ferreira Dos Reis',
            ra: '822156739',
            email: 'nathanreis.6739@aluno.saojudas.br',
            img: '/nathan',
        },
        'victor_araujo': {
            nome: 'Victor de Carvalho Araujo',
            ra: '822133651',
            email: 'victoraraujo.3651@aluno.saojudas.br',
            img: '/victor_araujo',
        },
        'victor_men': {
            nome: 'Victor Men dos Passos',
            ra: '822133744',
            email: 'victorpassos.3744@aluno.saojudas.br',
            img: '/victor_men',
        },
    };

    function htmlMember(member) {
        return (
            <div className="col-12 col-md-4 mb-4" key={member.ra}>
                <div className="card h-100">
                    <img src={`/assets/img/about${member.img}.png`} className="card-img-top" alt={member.nome} />
                    <div className="card-body">
                        <h5 className="card-title">{member.nome}</h5>
                        <p className="card-text m-0">
                            <b>RA:</b> {member.ra}
                        </p>
                        <p className="card-text">
                            <b>Email:</b> {member.email}
                        </p>
                    </div>
                </div>
            </div>
        );
    }

    const membersList = Object.keys(members).map(
        (member) => {
            return htmlMember(members[member]);
        }
    );

    return (
        <div className="row justify-content-around">
            {membersList}
        </div>
    );
}

function About(props) {

    return (
        <div>
            <div className="row">
                <div className="col-12">
                    <h1>
                        Sobre Nós
                        <hr></hr>
                    </h1>
                    <p>Este projeto surgiu na realização de uma atividade para a <a href="#">Universidade São Judas</a>. Com uma intenção
                        maior de apenas ganhar nota ao realizar um trabalho, mas sim desenvolver uma aplicação com objetivo claro de melhorar
                        a educação e a relação que ela desencadeia.
                    </p>
                </div>
            </div>
            <div className="row">
                <div className="col-12">
                    <p>
                        O projeto está conectado com o ODS 4, ao oferecer educação complementar para alunos do ensino fundamental e médio.
                        Com o  ODS 10, democratizar o acesso ao conhecimento e reduzir as desigualdades. Temos dois grandes objetivos:
                    </p>
                </div>
                <div className="col-12 col-md-6 mt-2">
                    <h5>Educação de Qualidade:</h5>
                    <p>
                        Assegurar a educação inclusiva e equitativa e de qualidade, e promover oportunidades
                        de aprendizagem ao longo da vida para todos.
                    </p>
                </div>
                <div className="col-12 col-md-6 mt-2">
                    <h5>Redução das Desigualdades:</h5>
                    <p>
                        Reduzir a desigualdade dentro dos países e entre eles.
                    </p>
                </div>
            </div>
            <div className="row mt-4">
                <div className="col-12">
                    <h1>
                        Quem Somos
                        <hr></hr>
                    </h1>
                    <p>Estes são os viajantes que decidiram juntos embarcar nessa jornada!</p>
                </div>
            </div>
            <Members />
        </div>
    );
}

export default About;