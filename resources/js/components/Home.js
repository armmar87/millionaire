import React from 'react';
import {Link} from "react-router-dom";

export default function Home() {
    return (
        <div className='home'>
            <h3>Millionaire</h3>
            <Link className="nav-link" to="/start-play">Start a game</Link>
        </div>
    )
}
