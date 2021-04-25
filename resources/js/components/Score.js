import React, {useEffect, useMemo, useState} from 'react';
import {Link, useHistory, useParams} from "react-router-dom";
import axios from "axios";

export default function Score() {

    const [data, setData] = useState([])

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/score').then(response => {
            setData(response.data)
        }).catch(err => console.log(err))
    }, [])

    return (
        <div className='score'>
            <h3><span>Score</span>: { data.point }</h3>
            <div>
                <Link className="nav-link" to="/start-play">Play agian</Link>
            </div>
        </div>
    )
}
