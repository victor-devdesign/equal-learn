
import React from "react";
import { Outlet } from "react-router-dom";
import { NavBar } from './components/NavBar';

const Layout = (options) => {

    const data = options.data;

    return (
        <div className="row">
            <div className="col-12">
                <NavBar logo={data.logo.small} profile={data.user.profile} name={data.user.name} />
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
        </div>
    );
};

export default Layout;