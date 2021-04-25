import React, {useEffect, useState} from 'react';
import api from "../util/api";

export default function Play() {
    const [data, setData] = useState([])

    useEffect(() => {
        api().get('api/start-play').then(response=>{
            setData(response.data)
        }).catch(err => console.log(err))
    }, [])

    return (
        <div>
            <table className="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>
                {
                    data.map(row=>{
                        return(
                            <tr key={row.id}>
                                <th scope="row">{row.id}</th>
                                <td>{row.title}</td>
                            </tr>
                        )
                    })
                }
                </tbody>
            </table>
        </div>
    )
}
