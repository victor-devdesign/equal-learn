import { FaFacebook, FaInstagram, FaLinkedinIn, FaTwitter, FaYoutube } from 'react-icons/fa'
import './style.css'

export const Footer = (data) => {
    return (
        <footer className="footer-default">
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <div className="footer-content">
                            <div className="row align-items-center">
                                <div className="col-12 col-md-4">
                                    <div className="footer-logo">
                                        <img src={data.logo} alt="Logo" />
                                    </div>
                                </div>
                                <div className="col-12 col-md-4">
                                    <div className="footer-menu">
                                        <ul className="nav">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/about">Sobre Nós</a></li>
                                            <li><a href="/contact">Contate-nos</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-12 col-md-4">
                                    <div className="footer-social">
                                        <ul className="nav">
                                            <li><a href="https://www.facebook.com/" target="_blank"><FaFacebook /></a></li>
                                            <li><a href="https://twitter.com/" target="_blank"><FaTwitter /></a></li>
                                            <li><a href="https://www.instagram.com/" target="_blank"><FaInstagram /></a></li>
                                            <li><a href="https://www.youtube.com/" target="_blank"><FaYoutube /></a></li>
                                            <li><a href="https://www.linkedin.com/" target="_blank"><FaLinkedinIn /></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div className="col-12">
                                    <div className="footer-copy">
                                        <p>© <a href='/'>Equal Learn</a> 2023 - Todos os direitos reservados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer >
    );
}