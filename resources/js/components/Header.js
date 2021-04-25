import React from 'react';
import { Switch, Route, Link } from 'react-router-dom';

import Home from './Home';
import Play from './Play';
import Score from './Score';
// import Question from './Question';
import Login from './Login';

export default function Header() {
    return (
        <div>
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <div className="container-fluid">
                    <Link className="navbar-brand" to="/">Millionaire</Link>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item">
                                <Link className="nav-link" to="/start-play">Plays</Link>
                            </li>
                            {/*<li className="nav-item">*/}
                            {/*    <Link className="nav-link" to="/questions">Questions</Link>*/}
                            {/*</li>*/}
                        </ul>
                    </div>
                    <div className="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            {/*<li className="nav-item">*/}
                            {/*    <Link className="nav-link" to="/login">Login</Link>*/}
                            {/*</li>*/}
                        </ul>
                    </div>
                </div>
            </nav>
            <Switch>
                <Route exact path='/' component={Home} />
                <Route exact path='/start-play' component={Play} />
                <Route exact path='/score' component={Score} />
                {/*<Route exact path='/questions' component={Question} />*/}
                {/*<Route exact path='/login' component={Login} />*/}
            </Switch>
        </div>
    )
}
