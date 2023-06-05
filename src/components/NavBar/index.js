import { Profile } from '../Profile';
import './style.css'

//-- Icon Import
import { FaSearch } from "react-icons/fa";

function Links(props) {
    const links = props.links;
    console.log(links);

    const activePage = (page) => {
        if (window.location.pathname === page) {
            return "active";
        } else if (window.location.pathname === "/" && page === "/") {
            return "active";
        } else {
            return "";
        }
    }

    let linksList = [];
    if (typeof links !== "undefined") {
        linksList = links.map((link, index) => {
            return (
                <li key={index}><a href={link.url} className={activePage(link.url)}>{link.title}</a></li>
            )
        });
    }
    return linksList;
}

export const NavBar = (data) => {

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
                                <Links links={data.links} />
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
