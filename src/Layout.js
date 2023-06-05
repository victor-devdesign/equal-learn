
import React from "react";
import { Outlet } from "react-router-dom";
import { NavBar } from './components/NavBar';
import { Footer } from './components/Footer';

const Layout = (options) => {

    const data = options.data;

    return (
        <div className="row main-content">
            <div className="col-12">
                <NavBar logo={data.logo.small} profile={data.user.profile} name={data.user.name} links={data.navbar.links} />
            </div>
            <div className="col-12">
                <main>
                    <div className="container">
                        <div className="card">
                            <div className="card-body">
                                <Outlet />
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div className="col-12">
                <Footer logo={data.logo.medium} />
            </div>
        </div>
    );
};

export default Layout;