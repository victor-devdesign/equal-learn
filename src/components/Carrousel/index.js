import './style.css'

// import Swiper core and required modules
import { Pagination, Autoplay } from 'swiper';

import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';


export const Carrousel = (options) => {

    console.log(options);

    return (
        <div className="carrousel-swiper">
            <Swiper
                modules={[Pagination, Autoplay]}

                pagination={{
                    dynamicBullets: true,
                    clickable: true,
                }}

                grabCursor={false}

                centeredSlides={true}

                autoplay={{
                    delay: 10000,
                    disableOnInteraction: false,
                }}

                className="CarrouselSwiper"
            // onSwiper={(swiper) => console.log(swiper)}
            // onSlideChange={() => console.log('slide change')}
            >
                <SwiperSlide>
                    <div className="carrousel-container">
                        <div className="carrousel-image">
                            <div className="bg-client-third-alpha-25"></div>
                        </div>
                        <div className="carrousel-text center mb-4">
                            <h1>Bem-vindo à plataforma de aprendizado mais incrível que você já viu!</h1>
                        </div>
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <div className="carrousel-image">
                            <div className="bg-client-third-alpha-25"></div>
                        </div>
                        <div className="carrousel-text start">
                            <span className="text-client-primary">O céu não é mais o limite!</span>
                            <h3>"Seu sonho está perto"</h3>
                            <p>Este é o sinal que você precisa para seguir seus sonhos! Deixe-nos te ajudar a alcançar seus objetivos com nossos planos de estudo. Clique no botão para acessar e descobrir nossos planos incríveis.</p>
                            <button className="btn btn-large btn-client-primary" type="button">Faça parte</button>
                        </div>
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <div className="carrousel-image">
                            <div className="bg-client-third-alpha-25"></div>
                        </div>
                        <div className="carrousel-text end">
                            <span className="text-client-secondary">Junte-se a nós agora mesmo!</span>
                            <h3>"Venha fazer parte da nossa equipe"</h3>
                            <p>Embarcamos em uma jornada espacial, aqui você pode criar conteúdo ou aprender com nossa comunidade. O que você está esperando?</p>
                            <button className="btn btn-large btn-client-secondary" type="button">Conheça-nos</button>
                        </div>
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <div className="carrousel-image">
                            <div className="bg-client-third-alpha-25"></div>
                        </div>
                        <div className="carrousel-text start">
                            <span className="text-client-primary">Estamos sempre prontos para ajudar!</span>
                            <h3>"Perguntas Frequentes"</h3>
                            <p>Para ajudá-lo, adicionamos uma seção de perguntas frequentes. Clique no botão para acessá-lo e obter respostas para todas as suas dúvidas.</p>
                            <button className="btn btn-large btn-outline-client-primary" type="button">FAQ</button>
                        </div>
                    </div>
                </SwiperSlide>

            </Swiper>
        </div>
    );
}
