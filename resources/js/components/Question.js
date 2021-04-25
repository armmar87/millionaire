import React, { useState, useEffect } from 'react';
import api from '../util/api'

export default function Question() {

    const [data, setData] = useState([])

    useEffect(() => {
        api().get('questions').then(response=>{
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
