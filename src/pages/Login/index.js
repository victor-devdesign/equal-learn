import React from 'react';

//-- Components import
import { Form, Input, Password, Button } from '../../components/Form';

//-- Icons import
import { FaFacebookF, FaLinkedinIn } from 'react-icons/fa';
import { FcGoogle } from 'react-icons/fc';

//-- Styles of Page
import './style.css'

function Login(options) {

    const data = options.data;

    return (
        <div className='row display-login'>
            <div className='col-12 col-md-4 login-info'>
                <h1>Cadastre-se</h1>
                <p>Caso ainda não tenha uma conta, crie clicando no botão a baixo.</p>
                <Button
                    id="login_cadastrar"
                    type="button"
                    typeFill="outline"
                    color="third"
                    name="login_cadastrar"
                    value="Cadastrar"
                >
                    Cadastrar
                </Button>
            </div>
            <div className='col-12 col-md-8 login-form'>
                <h1>Bem Vindo de Volta!</h1>
                <div className='login-container'>
                    <div className='row login-icons'>
                        <div className='col-12 col-md-4'>
                            <div className='login-icon'>
                                <FaFacebookF />
                            </div>
                        </div>
                        <div className='col-12 col-md-4'>
                            <div className='login-icon'>
                                <FcGoogle />
                            </div>
                        </div>
                        <div className='col-12 col-md-4'>
                            <div className='login-icon'>
                                <FaLinkedinIn />
                            </div>
                        </div>
                    </div>
                    <Form action="Contact" method="POST" class="login-form">
                        <div className='row'>
                            <div className='col-12 mb-4'>
                                <Input
                                    id="login_email"
                                    type="email"
                                    label="E-mail"
                                    class=""
                                    name="login_email"
                                    placeholder="Digite seu e-mail"
                                />
                            </div>
                            <div className='col-12 mb-4'>
                                <Password
                                    id="login_password"
                                    type="text"
                                    label="Senha"
                                    class=''
                                    name="login_password"
                                    placeholder="Digite sua senha"
                                />
                            </div>
                            <div className='col-12 mb-4 text-center'>
                                <Button
                                    id="login_submit"
                                    type="submit"
                                    typeFill="fill"
                                    color="primary"
                                    name="login_submit"
                                    value="Enviar"
                                >
                                    ENVIAR
                                </Button>
                            </div>
                        </div>
                    </Form>
                </div >
            </div >
        </div >
    );
}

export default Login;