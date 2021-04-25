import React, {useEffect, useMemo, useState} from 'react';
import { useParams } from "react-router-dom";
import {Link, useHistory} from "react-router-dom";
import axios from "axios";
import cc from 'classcat';

export default function Score() {

    let params = useParams();
    console.log(params)

    return (
        <div>
            <h1>Score</h1>
        </div>
    )
}
