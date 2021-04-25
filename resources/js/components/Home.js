import React from 'react';
import {Link} from "react-router-dom";

export default function Home() {
    return (
        <div className='home'>
            <h3>Start a game</h3>
            <Link className="nav-link" to="/start-play">Play</Link>
        </div>
    )
}
