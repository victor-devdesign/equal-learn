import React from 'react';
import { useState } from 'react';
import zxcvbn from 'zxcvbn';

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
 * @param {string} props.placeholder    - The placeholder of the input
 * @param {string} props.value          - The content of the input
 * 
 * @returns Interface of the input component
 */
function Input(props) {

    return (
        <div className='form-group'>
            <label htmlFor={props.id}>{props.label}</label>
            <input type={props.type} className={"form-control" + props.class} id={props.id} name={props.id} placeholder={props.placeholder} />
        </div>
    );
}

/**
 * Progressbar component
 * 
 * @param {object} props The properties of the password
 * 
 * @param {string} props.id             - The id of the progressbar
 * @param {string} props.value          - The value of the progressbar
 * @param {string} props.visible        - The visibility of the progressbar
 * @param {string} props.min            - The min value of the progressbar
 * @param {string} props.max            - The max value of the progressbar
 * 
 * @returns Interface of the input component | null
 */
function Progressbar(props) {

    if (!props.visible) {
        return null;
    }

    let progressbarColor = "";

    if (props.value < 25) {
        progressbarColor = "bg-danger";
    } else if (props.value < 50) {
        progressbarColor = "bg-warning";
    } else if (props.value < 75) {
        progressbarColor = "bg-info";
    } else {
        progressbarColor = "bg-success";
    }

    return (
        <div className="w-100 mt-3">
            <div className="progress">
                <div className={"progress-bar progress-bar-striped progress-bar-animated " + progressbarColor} role={props.id} style={{ width: props.value + "%" }} aria-valuenow={props.value} aria-valuemin="0" aria-valuemax="100">{props.value}%</div>
            </div>
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
 * @param {string} props.placeholder    - The placeholder of the password
 * @param {string} props.value          - The content of the password
 * @param {string} props.onChange       - The onChange event of the password
 * 
 * @param {object} props.strength               - The strength atributes of the password
 * @param {boolean} props.strength.validation   - The validation of the password
 * @param {boolean} props.strength.progress     - The progress of the password
 *  
 * @returns Interface of the password component
 */
function Password(props) {

    let [strength, setPasswordStrength] = useState(0);

    let progressVisible = false;
    try {
        progressVisible = typeof props.strength.progress !== "undefined" ? props.strength.progress === true : false;
    } catch (error) { }

    /**
     * Método de validação de evento para change do input
     * 
     * @param {*} event 
     * @returns 
     */
    let changeCallback = (event) => {
        event.preventDefault();

        try {
            return props.onChange(event);
        } catch (error) { }

        try {
            return props.strength.validation ? checkPasswordStrength(event) : null;
        } catch (error) { }

        return null;
    };

    /**
     * Método de validação padrão de senha e captura de força
     * @param {*} event 
     */
    const checkPasswordStrength = (event) => {
        let password = event.target.value,
            result = zxcvbn(password),
            value = 0,
            characterTypes = {},
            length = 0,
            differentiation = 0;

        // Check for character types
        characterTypes = {
            lowercase: /[a-z]/,
            uppercase: /[A-Z]/,
            numbers: /[0-9]/,
            special: /[^a-zA-Z0-9]/
        };

        // Calculate the password strength based on the result
        value = result.guesses_log10;

        // Check the number of character types present in the password
        for (const type in characterTypes) {
            if (characterTypes[type].test(password)) {
                // Weight multiplication by character type
                switch (type) {
                    case 'lowercase':
                        value *= 0.5;
                        break;

                    case 'uppercase':
                        value *= 3;
                        break;

                    case 'numbers':
                        value *= 6;
                        break;

                    case 'special':
                        value *= 10;
                        break;

                    default:
                        break;
                }

                differentiation++;
            }
        }

        // Set the value as an integer
        value = parseInt(value);

        // Check for additional password strength rules
        if (password.length <= 8) {
            value = Math.min(value, 80);
        }

        if (!characterTypes["lowercase"].test(password)) {
            value = Math.min(value, 85);
        }

        if (!characterTypes["uppercase"].test(password)) {
            value = Math.min(value, 65);
        }

        if (!characterTypes["numbers"].test(password)) {
            value = Math.min(value, 45);
        }

        if (!characterTypes["special"].test(password)) {
            value = Math.min(value, 35);
        }

        // Calculate the differentiation value based on the number of character types and additional rules
        differentiation = Math.min(differentiation, 1); // Limit differentiation to 1

        // Calculate the value based on differentiation and password length
        length = password.length;
        value += differentiation * 20; // Increase value based on differentiation

        // Apply maximum limits to the value based on password length
        if (length <= 2) {
            value = Math.min(value, 30);
        } else if (length <= 3) {
            value = Math.min(value, 50);
        } else if (length <= 5) {
            value = Math.min(value, 65);
        } else if (length <= 6) {
            value = Math.min(value, 75);
        } else if (length <= 8) {
            value = Math.min(value, 100);
        }

        setPasswordStrength(Math.min(value, 100));
    };

    return (
        <div className='form-group'>
            <label htmlFor={props.id}>{props.label}</label>
            <input type="password" className={"form-control" + props.class} id={props.id} name={props.id} placeholder={props.placeholder} data-strength={strength} onChange={changeCallback} />
            <Progressbar
                id="password_strength"
                value={strength}
                visible={progressVisible ?? 0}
                min="0"
                max="100"
            />
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
            <label htmlFor={props.id}>{props.label}</label>
            <textarea className={"form-control" + props.class} id={props.id} name={props.id} placeholder={props.placeholder} rows={props.rows} cols={props.cols}>{props.children}</textarea>
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
 * @param {string} props.placeholder    - The placeholder of the select
 * @param {string} props.children       - The content of the select
 * 
 * @returns Interface of the select component
 */
function Select(props) {

    return (
        <div className='form-group'>
            <label htmlFor={props.id}>{props.label}</label>
            <select className={"form-control" + props.class} id={props.id} name={props.id} placeholder={props.placeholder}>{props.children}</select>
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
 * @param {string} props.value          - The value of the button
 * @param {callback} props.click        - The click callback function of button
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

    //-- Set click event action
    function handleClick(e) {
        e.preventDefault();
        if (props.click !== undefined) {
            props.click(e);
        }
    }

    return (
        <button
            type={props.type}
            className={
                "btn btn-" + data.fill + props.color + data.class
            }
            id={props.id}
            name={props.id}
            value={props.value}
            onClick={handleClick}
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