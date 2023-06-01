//-- Components import
import { useState } from 'react';
import { Form, Input, Password, Button } from '../../components/Form';
import zxcvbn from 'zxcvbn';

function Signup() {
    const [passwordStrength, setPasswordStrength] = useState('');

    const checkPasswordStrength = (event) => {
        const password = event.target.value;
        const result = zxcvbn(password);

        // Define a força da senha com base no resultado do zxcvbn
        switch (result.score) {
            case 0:
                setPasswordStrength('Fraca');
                break;
            case 1:
                setPasswordStrength('Média');
                break;
            case 2:
                setPasswordStrength('Forte');
                break;
            case 3:
                setPasswordStrength('Muito Forte');
                break;
            default:
                setPasswordStrength('');
        }
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        // Lógica para submissão do formulário
    };

    return (
        <div>
            <h1>Tela de Cadastro</h1>

            <p>
                <b>Ainda não é um viajante?</b>
                <br></br>
                Venha embarcar nesse foguete com a gente. Preencha os campos abaixo para se cadastrar:
            </p>

            <div id="messages"></div>

            <Form action="Signup" method="POST" class="signup-form" onSubmit={handleSubmit}>
                <div className='row'>
                    <div className="col-12 col-md-6 mb-4">
                        <Input
                            id="signup_nome"
                            type="text"
                            label="Nome"
                            class=""
                            placeholder="Digite seu nome"
                        />
                    </div>

                    <div className="col-12 col-md-6 mb-4">
                        <Input
                            id="signup_email"
                            type="email"
                            label="E-mail"
                            class=""
                            placeholder="Digite seu e-mail"
                        />
                    </div>

                </div>

                <div className='row'>
                    <div className="col-12 mb-4">
                        <progress
                            id="password-strength"
                            value={passwordStrength !== '' ? (passwordStrength === 'Muito Forte' ? '100' : '75') : '0'}
                            max="100"
                        ></progress>
                        {passwordStrength && <p>Força da senha: {passwordStrength}</p>}
                    </div>
                </div>

                <div className='row'>

                    <div className="col-12 col-md-6 mb-4">
                        <Password
                            id="signup_senha"
                            type="password"
                            label="Senha"
                            class=""
                            placeholder="Digite sua senha"
                            onChange={checkPasswordStrength}
                        />
                    </div>

                    <div className="col-12 col-md-6 mb-4">
                        <Password
                            id="signup_senha_confirmacao"
                            type="password"
                            label="Confirmação de Senha"
                            class=""
                            placeholder="Confirme sua senha"
                        />
                    </div>

                    <div className="col-12 mt-2">
                        <div className="d-flex justify-content-center">
                            <Button
                                id="signup_submit"
                                type="submit"
                                typeFill="fill"
                                color="primary"
                                name="signup_submit"
                                value="Cadastrar"
                            >
                                CADASTRAR
                            </Button>
                        </div>
                    </div>

                    <div className="col-12">
                        {passwordStrength && <p>Força da senha: {passwordStrength}</p>}
                    </div>
                </div>
            </Form>
        </div>
    );
}

export default Signup;
