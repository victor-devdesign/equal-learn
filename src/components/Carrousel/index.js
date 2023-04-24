import './style.css'

// import Swiper core and required modules
import { Pagination, EffectCreative, Autoplay } from 'swiper';

import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';


export const Carrousel = (options) => {

    let logo = options.url + 'assets/img/avatar.jpg';

    return (
        <div className="carrousel-swiper">
            <Swiper
                modules={[Pagination, EffectCreative, Autoplay]}

                pagination={{
                    dynamicBullets: true,
                    clickable: true,
                }}

                grabCursor={false}

                effect={"creative"}
                creativeEffect={{
                    prev: {
                        shadow: true,
                        translate: [0, 0, -10],
                    },
                    next: {
                        translate: ["100%", 0, 0],
                    },
                }}

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
                        <img src={logo} className="col-12" height="750px" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <img src={logo} className="col-12" height="750px" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <img src={logo} className="col-12" height="750px" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <img src={logo} className="col-12" height="750px" />
                    </div>
                </SwiperSlide>
                <SwiperSlide>
                    <div className="carrousel-container">
                        <img src={logo} className="col-12" height="750px" />
                    </div>
                </SwiperSlide>

            </Swiper>
        </div>
    );
}
