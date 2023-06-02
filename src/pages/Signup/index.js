//-- Components import
import { Form, Input, Password, Button } from '../../components/Form';

//-- Import Icons
import { ImCheckmark } from 'react-icons/im';

function Signup() {

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

                    <div className="col-12 col-md-6 mb-4">
                        <Password
                            id="signup_senha"
                            type="password"
                            label="Senha"
                            class=""
                            placeholder="Digite sua senha"
                            strength={{ validation: true, progress: true }}
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

                    <div className="col-12 col-md-6 mb-4">
                        {/* Regras para força de senha */}
                        <h5>Regras para força de senha:</h5>
                        <p className="mb-2">A senha deve conter:</p>
                        <ul className="list-unstyled ms-2">
                            <li><ImCheckmark /> Mínimo de 8 caracteres</li>
                            <li><ImCheckmark /> Mínimo de 1 letra maiúscula</li>
                            <li><ImCheckmark /> Mínimo de 1 letra minúscula</li>
                            <li><ImCheckmark /> Mínimo de 1 número</li>
                            <li><ImCheckmark /> Mínimo de 1 caractere especial</li>
                        </ul>
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
                </div>
            </Form>
        </div>
    );
}

export default Signup;
