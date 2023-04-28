import './style.css'

//-- Icon Import
import { FaUserCircle } from "react-icons/fa";

export const Profile = (data) => {

    console.log(data);

    if (data.logged) {
        return (
            <li className="bg-field"><a href="profile">Profile</a>
                <img src={data.profile} alt={data.name} />
            </li>
        );
    } else {
        return (
            <li className="bg-field icon-field"><a href="login">Login</a>
                <FaUserCircle />
            </li>
        );
    }
}
