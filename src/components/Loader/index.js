import './style.css'

export default function Loader() {

    return (
        <div className="loading-container">
            <div className="loader">
                <div className="loader-inner">
                    <div className="loader-line-wrap">
                        <div className="loader-line"></div>
                    </div>
                    <div className="loader-line-wrap">
                        <div className="loader-line"></div>
                    </div>
                    <div className="loader-line-wrap">
                        <div className="loader-line"></div>
                    </div>
                    <div className="loader-line-wrap">
                        <div className="loader-line"></div>
                    </div>
                    <div className="loader-line-wrap">
                        <div className="loader-line"></div>
                    </div>
                </div>
            </div>
        </div>
    );
}
