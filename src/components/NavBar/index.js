import { Profile } from '../Profile/index.js';
import './style.css'

//-- Icon Import
import { FaSearch } from "react-icons/fa";

export const NavBar = (data) => {

    return (
        <header className="header-default">
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <nav className="nav-default">
                            {/* <!-- ----- Logo ----- */}
                            <a href="index.html" className="logo">
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
                                <li><a href="index.html" className="active">Home</a></li>
                                <li><a href="browse.html">Browse</a></li>
                                <li><a href="details.html">Details</a></li>
                                <li><a href="streams.html">Streams</a></li>
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
