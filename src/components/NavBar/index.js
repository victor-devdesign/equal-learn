import { Profile } from '../Profile';
import './style.css'

//-- Icon Import
import { FaSearch } from "react-icons/fa";

export const NavBar = (data) => {

    const activePage = (page) => {
        if (window.location.pathname === "/" + page) {
            return "active";
        } else if (window.location.pathname === "/" && page == "home") {
            return "active";
        } else {
            return "";
        }
    }

    return (
        <header className="header-default">
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <nav className="nav-default">
                            {/* <!-- ----- Logo ----- */}
                            <a href="/" className="logo">
                                <img src={data.logo} alt="Logo" />
                            </a>
                            {/* <!-- ----- Search ----- */}
                            <div className="search-input">
                                <form id="search" action="#">
                                    <input className="bg-field" type="text" placeholder="Pesquisar ..." id='search_index' name="search_index" />
                                    <FaSearch />
                                </form>
                            </div>
                            {/* <!-- ----- Menu ----- */}
                            <ul className="nav">
                                <li><a href="/" className={activePage('home')}>Home</a></li>
                                <li><a href="/about" className={activePage('about')}>Sobre Nós</a></li>
                                <li><a href="/contact" className={activePage('contact')}>Contate-nos</a></li>
                                <Profile
                                    logged={typeof data.profile !== "undefined" && typeof data.name !== "undefined"}
                                    profile={data.profile}
                                    name={data.name}
                                />
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    );
}
