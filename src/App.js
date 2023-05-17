//-- Default import
import { useState, useEffect } from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";

//-- Pages Import
import Home from "./pages/Home";
import LoggedHome from "./pages/LoggedHome";
import Http404 from "./pages/Http404";
import About from "./pages/About";
import Contact from "./pages/Contact";
import Layout from "./Layout.js";

//-- Loader Page
import Loader from './components/Loader';

/**
 * The path of the API
 * @param {string} API_URL
*/
const API_URL = "http://localhost/equal-learn/public/Api/";

/**
 * Get a list of initial data for the application
 * 
 * @returns {object} data
 */
function getData() {
  return fetch(API_URL + "MetaTags/getMetaTags", {
    method: "POST",
    body: JSON.stringify({
      app: document.location.origin,
      csrf_cookie_name: 'e6677284dffb96a3881fd6967f4ed60a'
    }),
    mode: "no-cors",
  }).then(response => {
    console.log(response.json());
    return response.json();
  })
    .then((data) => {
      console.log(data);
      return data;
    })
    .catch((error) => {
      console.error("Error:", error);
      return null;
    });
}

export default function App() {

  const [data, setData] = useState(null);

  useEffect(() => {
    getData().then((data) => setData(data));
  }, []);

  if (data == null) {
    return (
      <div>
        <Loader />
      </div>
    );
  }

  /**
   * Set the home page if the user is logged in or not
   * 
   * @returns JSX.Element
   */
  function setHome() {
    if (typeof data.user.profile !== "undefined" && typeof data.user.name !== "undefined") {
      return <LoggedHome data={data} />
    } else {
      return <Home data={data} />
    }
  }

  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout data={data} />}>
          {/* Normal linked pages */}
          <Route index element={setHome()} />
          <Route path="about" element={<About data={data} />} />
          <Route path="contact" element={<Contact data={data} />} />

          {/* HTTP 404 Page Not Found */}
          <Route path="/*" element={<Http404 data={data} />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}