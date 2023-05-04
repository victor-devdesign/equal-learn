import { useState, useEffect } from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";

import Home from "./pages/Home/index.js";
import About from "./pages/About/index.js";
import Contact from "./pages/Contact/index.js";
import Layout from "./Layout.js";

import Loader from './components/Loader/index.js';

const API_URL = "http://localhost/equal-learn/public/Api/";

function getData() {
  // return fetch(API_URL + "MetaTags/getMetaTags").then((response) => response.json());
  console.log("Load Api");
  return {
    url: document.location.origin + "/",
    logo: {
      small: document.location.origin + "/assets/img/logo/small_logo.png",
      medium: document.location.origin + "/assets/img/logo/medium_logo.png",
      large: document.location.origin + "/assets/img/logo/large_logo.png",
    },
    metas: {},
    user: {
      // id: "1",
      // name: "Cléber da Costa",
      // role: "free_user",
      // profile: document.location.origin + "/assets/img/avatar.jpg",
      // roles: {},
    },
  };
}

export default function App() {

  const [data, setData] = useState(null);

  useEffect(() => {
    setData(getData());
  }, []);

  if (data === null) {
    return (
      <div>
        <Loader />
      </div>
    );
  }

  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout data={data} />}>
          <Route index element={<Home data={data} />} />
          <Route path="about" element={<About data={data} />} />
          <Route path="contact" element={<Contact data={data} />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}