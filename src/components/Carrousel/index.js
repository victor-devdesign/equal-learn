import './style.css'
import { Slide } from './Slide'

// import Swiper core and required modules
import { Pagination, Autoplay } from 'swiper';

import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';


export const Carrousel = (options) => {

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
                            <img className="img-fluid" src="https://picsum.photos/1300/500?random=1&grayscale&blur=2" alt="Bem-vindo à plataforma" />
                        </div>
                        <div className="carrousel-text center mb-4">
                            <h1>Bem-vindo à plataforma de aprendizado mais incrível que você já viu!</h1>
                        </div>
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <Slide
                        svg={{
                            src: "slide_01",
                            title: "Seu sonho está perto",
                        }}
                        span={{
                            type: "text-client-primary",
                            text: "O céu não é mais o limite!",
                        }}
                        title={"Seu sonho está perto"}
                        desc={"Este é o sinal que você precisa para seguir seus sonhos! Deixe-nos te ajudar a alcançar seus objetivos com nossos planos de estudo. Clique no botão para acessar e descobrir nossos planos incríveis."}
                        btn={{
                            text: "Faça parte",
                            link: "/",
                            type: "btn-client-primary"
                        }}
                        position={"start"}
                    />
                </SwiperSlide>
                <SwiperSlide>
                    <Slide
                        svg={{
                            src: "slide_02",
                            title: "Venha fazer parte da nossa equipe",
                        }}
                        span={{
                            type: "text-client-secondary",
                            text: "Junte-se a nós agora mesmo!"
                        }}
                        title={"Venha fazer parte da nossa equipe"}
                        desc={"Embarcamos em uma jornada espacial, aqui você pode criar conteúdo ou aprender com nossa comunidade. O que você está esperando?"}
                        btn={{
                            text: "Conheça-nos",
                            link: "/",
                            type: "btn-client-secondary"
                        }}
                        position={"end"}
                    />
                </SwiperSlide>
                <SwiperSlide>
                    <Slide
                        svg={{
                            src: "slide_03",
                            title: "Perguntas Frequentes",
                        }}
                        span={{
                            type: "text-client-primary",
                            text: "Estamos sempre prontos para ajudar!"
                        }}
                        title={"Perguntas Frequentes"}
                        desc={"Para ajudá-lo, adicionamos uma seção de perguntas frequentes. Clique no botão para acessá-lo e obter respostas para todas as suas dúvidas."}
                        btn={{
                            text: "FAQ",
                            link: "/",
                            type: "btn-client-primary"
                        }}
                        position={"start"}
                    />
                </SwiperSlide>

            </Swiper>
        </div>
    );
}
