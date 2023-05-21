import React from 'react';

//-- Components import
import { Form, Input, Textarea, Button } from '../../components/Form';
import Earth from '../../components/Earth';

//-- Styles of Page
import './style.css'

function Contact(options) {

    const data = options.data;

    return (
        <div className='row display-contact'>
            <h1>Contate-nos</h1>
            <p>Alguma dúvida? Mande para nós. <br></br> Nossa meta é você ter o mundo a um click de distância!</p>
            <div className='col-6'>
                <Form action="Contact" method="POST" class="contact-form">
                    <div className='row'>
                        <div className='col-12 mb-4'>
                            <Input
                                id="contact_name"
                                type="text"
                                label="Nome"
                                class=""
                                name="contact_name"
                                placeholder="Digite seu nome"
                                value={data.contact_name}
                            />
                        </div>
                        <div className='col-12 mb-4'>
                            <Input
                                id="contact_email"
                                type="email"
                                label="E-mail"
                                class=""
                                name="contact_email"
                                placeholder="Digite seu e-mail"
                                value={data.contact_email}
                            />
                        </div>
                        <div className='col-12 mb-4'>
                            <Input
                                id="contact_subject"
                                type="text"
                                label="Assunto"
                                class=''
                                name="contact_subject"
                                placeholder="Digite o assunto"
                                value={data.contact_subject}
                            />
                        </div>
                        <div className='col-12 mb-4'>
                            <Textarea
                                id="contact_message"
                                label="Mensagem"
                                class=''
                                name="contact_message"
                                placeholder="Digite sua mensagem"
                                rows="6"
                                cols="50"
                                value={data.contact_message}
                            />
                        </div>
                        <div className='col-12 mb-4'>
                            <Button
                                id="contact_submit"
                                type="submit"
                                typeFill="fill"
                                color="primary"
                                name="contact_submit"
                                value="Enviar"
                            >
                                Enviar
                            </Button>
                        </div>
                    </div>
                </Form>
            </div>
            <div className='col-6 p-4'>
                <Earth />
            </div>
        </div>
    );
}

export default Contact;