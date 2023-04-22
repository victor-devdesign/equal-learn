import './style.css'

export const NavBar = (options) => {

    let logo = options.url + 'assets/img/logo/small_logo.png',
        profileUrl = options.url + options.profileUrl + '';

    return (
        <header className="header-default">
            <div className="container">
                <div className="row">
                    <div className="col-12">
                        <nav className="nav-default">
                            {/* <!-- ----- Logo ----- */}
                            <a href="index.html" className="logo">
                                <img src={logo} alt="Logo" />
                            </a>
                            {/* <!-- ----- Search ----- */}
                            <div className="search-input">
                                <form id="search" action="#">
                                    <input className="bg-field" type="text" placeholder="Pesquisar ..." id='search_index' name="search_index" onkeypress="handle" />
                                    <i className="fa fa-search"></i>
                                </form>
                            </div>
                            {/* <!-- ----- Menu ----- */}
                            <ul className="nav">
                                <li><a href="index.html" className="active">Home</a></li>
                                <li><a href="browse.html">Browse</a></li>
                                <li><a href="details.html">Details</a></li>
                                <li><a href="streams.html">Streams</a></li>
                                <li className="bg-field"><a href="profile.html">Profile</a>
                                    <img src={profileUrl} alt={options.profileName} /></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    );
}
