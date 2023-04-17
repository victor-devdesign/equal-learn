import about from '../../../src/pages/About/index.js';
import home from '../../../src/pages/Home/index.js';
import contact from '../../../src/pages/Contact/index.js';
import createPage from './create-page.js';
import Navigation from '../../../src/components/Navigation/index.js';

const {
    BrowserRouter,
    Switch,
    Route
} = ReactRouterDOM;

const {
    createElement
} = React;

const Main = () => createElement(
    "main",
    null,
    createElement(
        Switch,
        null,
        createElement(
            Route, {
            exact: true,
            path: "/equal-learn/public/",
            component: home
        }
        ),
        createElement(
            Route, {
            exact: true,
            path: "/equal-learn/public/about",
            component: about
        }
        ),
        createElement(
            Route, {
            exact: true,
            path: "/equal-learn/public/contact",
            component: contact
        }
        ),
        createElement(
            Route, {
            exact: true,
            path: "*",
            component: createPage('404', '404 Page')
        }
        )
    )
);

const Header = () => createElement(
    'header',
    null,
    createElement(Navigation)
);

const App = () => createElement(
    "div",
    null,
    createElement(Header, null),
    createElement(Main, null)
);

ReactDOM.render(
    createElement(
        BrowserRouter,
        null,
        createElement(App, null)
    ),
    document.getElementById('root')
);

// https://reactjs.org/docs/react-without-jsx.html
// https://www.pluralsight.com/guides/just-plain-react
// https://codepen.io/pshrmn/pen/YZXZqM?editors=1010
// https://stackoverflow.com/questions/53527465/how-can-i-do-string-interpolation-in-a-string-variable-in-react