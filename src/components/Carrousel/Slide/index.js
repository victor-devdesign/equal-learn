import '../style.css'

export const Slide = (options) => {

    return (
        <div className="carrousel-container">
            <div className="carrousel-image">
                <img className="img-fluid" src={options.img.src} alt={options.img.title} />
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