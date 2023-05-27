import React from 'react';

//-- Styles of Page
import './style.css'

/**
 * Input component
 * 
 * @param {object} props The properties of the input
 * 
 * @param {string} props.id             - The id of the input
 * @param {string} props.type           - The type of the input [text, email, password, number, date, file]
 * @param {string} props.label          - The label of the input
 * @param {string} props.class          - The class of the input
 * @param {string} props.name           - The name of the input
 * @param {string} props.placeholder    - The placeholder of the input
 * @param {string} props.value          - The content of the input
 * 
 * @returns Interface of the input component
 */
function Input(props) {

    return (
        <div className='form-group'>
            <label for={props.id}>{props.label}</label>
            <input type={props.type} className={"form-control" + props.class} id={props.id} name={props.name} placeholder={props.placeholder} />
        </div>
    );
}

/**
 * Password component
 * 
 * @param {object} props The properties of the password
 * 
 * @param {string} props.id             - The id of the password
 * @param {string} props.label          - The label of the password
 * @param {string} props.class          - The class of the password
 * @param {string} props.name           - The name of the password
 * @param {string} props.placeholder    - The placeholder of the password
 * @param {string} props.value          - The content of the password
 * 
 * @returns Interface of the password component
 */
function Password(props) {

    return (
        <div className='form-group'>
            <label for={props.id}>{props.label}</label>
            <input type="password" className={"form-control" + props.class} id={props.id} name={props.name} placeholder={props.placeholder} />
        </div>
    );
}

/**
 * Textarea component
 * 
 * @param {object} props The properties of the textarea
 * 
 * @param {string} props.id             - The id of the textarea
 * @param {string} props.label          - The label of the textarea
 * @param {string} props.class          - The class of the textarea
 * @param {string} props.name           - The name of the textarea
 * @param {string} props.placeholder    - The placeholder of the textarea
 * @param {string} props.rows           - The rows of the textarea
 * @param {string} props.cols           - The height of the textarea
 * @param {string} props.children       - The content of the textarea
 *  
 * @returns Interface of the textarea component
 */
function Textarea(props) {

    return (
        <div className='form-group'>
            <label for={props.id}>{props.label}</label>
            <textarea className={"form-control" + props.class} id={props.id} name={props.name} placeholder={props.placeholder} rows={props.rows} cols={props.cols}>{props.children}</textarea>
        </div>
    );
}

/**
 * Select component
 * 
 * @param {object} props The properties of the select
 * 
 * @param {string} props.id             - The id of the select
 * @param {string} props.label          - The label of the select
 * @param {string} props.class          - The class of the select
 * @param {string} props.name           - The name of the select
 * @param {string} props.placeholder    - The placeholder of the select
 * @param {string} props.children       - The content of the select
 * 
 * @returns Interface of the select component
 */
function Select(props) {

    return (
        <div className='form-group'>
            <label for={props.id}>{props.label}</label>
            <select className={"form-control" + props.class} id={props.id} name={props.name} placeholder={props.placeholder}>{props.children}</select>
        </div>
    );
}

/**
 * Option component
 * 
 * @param {object} props The properties of the option
 * 
 * @param {string} props.value          - The value of the option
 * @param {string} props.children       - The content of the option
 * 
 * @returns Interface of the option component
 */
function Option(props) {

    return (
        <option value={props.value}>{props.children}</option>
    );
}

/**
 * Button component
 * 
 * @param {object} props The properties of the button
 * 
 * @param {string} props.id             - The id of the button
 * @param {string} props.type           - The type of the button [button, submit, reset]
 * @param {string} props.typeFill       - The fill class of the button [outline, fill, clear]
 * @param {string} props.color          - The color of the button [primary, secondary, success, danger, warning, info, light, dark]
 * @param {boolean} props.disabled      - The disabled of the button [true, false]
 * @param {string} props.class          - The class of the button
 * @param {string} props.name           - The name of the button
 * @param {string} props.value          - The value of the button
 * @param {string} props.children       - The content of the button
 * 
 * @returns Interface of the button component
 */
function Button(props) {

    const data = {}; //-- Filter data of the button

    //-- Filter of fill class
    data.fill = "client-";
    if (props.typeFill === "outline") {
        data.fill = "outline-client-";
    } else if (props.typeFill === "clear") {
        data.fill = "";
    }

    //-- Filter of class
    data.class = "";
    if (props.class !== undefined) {
        data.class = " " + props.class ?? "";
    }

    //-- Filter of disabled
    if (props.disabled === true) {
        data.class += " disabled";
    }

    return (
        <button
            type={props.type}
            className={
                "btn btn-" + data.fill + props.color + data.class
            }
            id={props.id}
            name={props.name}
            value={props.value}
        >
            {props.children}
        </button>
    );
}

/**
 * Form component
 * 
 * @param {object} props The properties of the form
 * 
 * @param {string} props.action         - The action of the form
 * @param {string} props.method         - The method of the form [GET, POST]
 * @param {string} props.class          - The class of the form
 * @param {string} props.children       - The content of the form
 */
function Form(props) {

    return (
        <form action={props.action} method={props.method} className={"form-container " + props.class}>
            {props.children}
        </form>
    );
}


export { Form, Input, Password, Textarea, Select, Option, Button };