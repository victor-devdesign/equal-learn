const {
    NavLink
} = ReactRouterDOM;

const {
    Component,
    createElement
} = React;

class Navigation extends Component {
    render() {
        return createElement(
            "div",
            {
                className: "menu"
            },
            createElement(NavLink, { to: "/equal-learn/public/", exact: true }, "Home"),
            createElement(NavLink, { to: "/equal-learn/public/about", exact: true }, "About"),
            createElement(NavLink, { to: "/equal-learn/public/contact", exact: true }, "Contact")
        );
    }
}

export default Navigation;