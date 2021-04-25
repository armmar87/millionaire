import React, {useEffect, useMemo, useState} from 'react';
import { useHistory } from "react-router-dom";
import axios from "axios";
import cc from 'classcat';

export default function Play() {

    const [data, setData] = useState(null)
    const [userAnswers, setUserAnswers] = useState([]);
    const [isChecked, setCheck] = useState(false);
    const history = useHistory();

    const fetchData = () => {
        axios.get('http://127.0.0.1:8000/api/start-play').then(response => {
            setData(response.data)
        }).catch(err => console.log(err));
    }

    useEffect(() => { fetchData() }, [])
    useEffect(() => {
        setUserAnswers([]);
        setCheck(false)
    }, [data])

    const getAttempts = data?.play?.attempt || 1
    const getStep = data?.play?.step || 1

    const handleClick = (row) => {
        let answers = [...userAnswers];
        if(answers.includes(row.id)){
            answers = answers.filter(value => value !== row.id)
        } else {
            answers = answers.concat(row.id);
        }
        setUserAnswers(answers);
    }

    const isAnswersValid = useMemo(() => {
        if(data && data.question && data.question.answers) {
            const trueAnswers = data.question.answers.filter(value => value.correct).map(value => value.id);
            const checkByUser = trueAnswers.every(answer => userAnswers.includes(answer));
            const checkByAnswer = userAnswers.every(answer => trueAnswers.includes(answer));
            return checkByUser && checkByAnswer;
        }
        return false
    }, [data?.question?.answers, userAnswers])

    const handleCheck = () => {
        setCheck(true);
        if (isAnswersValid) {
            alert('You answered correctly')
        } else {
            alert('You answered wrong')
        }
    }

    const handleNext = async () => {
        const params = {'question_id': data.question.id, 'correct_answer': isAnswersValid}
        await axios.post('http://127.0.0.1:8000/api/add-answer', params)
        if (data?.play?.step === 5) {
            history.push('/score');
        } else {
            fetchData()
        }
    }

    if (!data) {
        return null;
    }
    return (
        <div className="play">
            <h3><span>Play</span>: { getAttempts }</h3>
            <h5><span>Step</span>: { getStep }</h5>
            <h5 className='play__level'><span>Level</span>: { data.question.level }</h5>
            <h4><span>Question</span>: { data.question.title }</h4>
            {
                data.question.answers.map(row => {
                    const isAnswerIncluded = userAnswers.includes(row.id)
                    return (<div className={cc(['play__answer', {
                        'play__answer--wrong': (isAnswerIncluded && !row.correct) && isChecked,
                        'play__answer--correct': isChecked && row.correct,
                        'play__answer--active': isAnswerIncluded,
                    }])}
                                 onClick={() => handleClick(row)} key={row.id}>
                        {row.title}
                    </div>)
                })
            }

            {!isChecked && <button onClick={handleCheck}>Check</button>}
            {isChecked && <button onClick={handleNext}>Next</button>}
        </div>
    )
}
