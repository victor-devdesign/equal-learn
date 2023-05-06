import '../style.css'

import { SVG_00, SVG_01, SVG_02, SVG_03 } from './svg/index';

export const Slide = (options) => {

    function svgFilter(slide) {
        switch (slide) {
            case "slide_01":
                return <SVG_01 />;
            case "slide_02":
                return <SVG_02 />;
            case "slide_03":
                return <SVG_03 />;
            default:
                return <SVG_00 />;
        }
    }

    return (
        <div className="carrousel-container">
            <div className="carrousel-image">
                {svgFilter(options.svg.src)}
            </div>
            <div className={"carrousel-text " + options.position}>
                <span className={options.span.type}>{options.span.text}</span>
                <h3>{'"' + options.title + '"'}</h3>
                <p>{options.desc}</p>
                <button className={"btn btn-large " + options.btn.type} type="button" data-link={options.btn.link}>{options.btn.text}</button>
            </div>
        </div>
    )

}