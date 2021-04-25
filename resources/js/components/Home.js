import React from 'react';
import {Link} from "react-router-dom";

export default function Home() {
    return (
        <div>
            <h1>Start a game</h1>
            <Link className="nav-link" to="/start-play">Plays</Link>
        </div>
    )
}
