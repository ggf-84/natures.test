import React from 'react';
import Icon from './Icon'
import Title from './Title'
import Text from './Text'
import ProgressBar from './ProgressBar'
import Select from './Select'
import RadioBtn from './RadioBtn'
import Arrow from './Arrow'
import Button from './Button'
import Input from './Input'
import Switch from './Switch'
import Checkbox from './Checkbox'
import {Consumer} from '../context'
import styled from "styled-components";
import bg from "../assets/img/bg.png"
import footerLeft from "../assets/img/footer-left.svg"
import footerRight from "../assets/img/footer-right.svg"
import close from "../assets/img/close.svg"

const main = document.getElementById('main');
// const quizEl = document.querySelector('.hidden');

export default function Quiz({data}) {

    let quizEl = document.getElementsByClassName("hidden");
    main.classList.add('loader');

    setTimeout(() => {
        main.classList.remove('loader');
        if(quizEl.length > 0) { quizEl[0].classList.remove("hidden"); }
    }, 500)

    return <div className="hidden">
    <QuizWrapper>
        <a href="/">
            <img src={close} className="close-calculator"/>
        </a>

        <Consumer className="quiz">
        {value => {
            const {updateProgressBarData, steps, showResultBtn, loaded, addCar, moreCars, nrOfCars} = value;
            var currentStep = false;
            var resultCO2 = 0;

            return (<>
                {
                     data.map((dataArr, j) => {
                        if (Object.values(dataArr[1]).length > 1) {
                            return(
                                Object.values(dataArr[1]).map((el, n) => {
                                    if(steps[dataArr[0]]){
                                        currentStep = dataArr[0];

                                        if(el.unit_measure !== 'mpg') {
                                            if((el.unit_measure !== 'miles' && el.custom_formula !== 1) || (el.unit_measure !== 'miles' && el.custom_formula === 1)){
                                                return <div key={`a-${n}`} className={'wrap'}>

                                                    {el.icon &&
                                                    <Icon
                                                        icon={`${el.icon}`}
                                                        center="center"
                                                        key={`b-${n}-${j}`}
                                                    />}

                                                    {el.question &&
                                                    <Title
                                                        title={`${el.question}`}
                                                        center={'center'}
                                                        type={true}
                                                        transport={false}
                                                        key={`c-${n}-${j}`}
                                                    />}

                                                    {el.description &&
                                                    <Title
                                                        title={`${el.description}`}
                                                        center={'center'}
                                                        type={false}
                                                        key={`d-${n}-${j}`}
                                                    />}

                                                    {(el.quiz_type) === 'progress' &&
                                                    <ProgressBar
                                                        progressData={`${el.label_question}`}
                                                        unitMeasure={`${el.unit_measure}`}
                                                        center="center"
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        key={`e-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {(el.quiz_type) === 'select' &&
                                                    <Select
                                                        progressData={`${el.label_question}`}
                                                        unitMeasure={`${el.unit_measure}`}
                                                        center="center"
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        key={`f-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {(el.quiz_type) === 'checkbox' &&
                                                    <Checkbox
                                                        unitMeasure={`${el.unit_measure}`}
                                                        progressData={`${el.label_question}`}
                                                        center="center"
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        key={`g-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {(el.quiz_type) === 'input' &&
                                                    <Input
                                                        unitMeasure={`${el.unit_measure}`}
                                                        center="center"
                                                        custom={0}
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        key={`h-${n}-${j}`}
                                                        defaultValue="1"
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {el.quiz_type === 'radio' &&
                                                    <RadioBtn
                                                        progressData={`${el.label_question}`}
                                                        unitMeasure={`${el.unit_measure}`}
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        center={'center'}
                                                        key={`k-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {(el.quiz_type) === 'switch' &&
                                                    <Switch
                                                        progressData={`${el.label_question}`}
                                                        center="center"
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        key={`l-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {el.custom_field === 1 &&
                                                    <Input
                                                        unitMeasure={`${el.unit_measure}`}
                                                        center={'center'}
                                                        custom={1}
                                                        qty={`${el.formula_qty}`}
                                                        curentStep={currentStep}
                                                        qty={el.formula_qty}
                                                        id={`${n}-${j}`}
                                                        key={`m-${n}-${j}`}
                                                        car={false}
                                                        el={null}
                                                        step={null}
                                                    />}

                                                    {(el.quiz_type === "text") &&
                                                    <Text
                                                        unitMeasure={`${el.unit_measure}`}
                                                        progressData={`${el.label_question}`}
                                                        center="center"
                                                        key={`n-${n}-${j}`}
                                                    />}
                                                </div>
                                            }
                                        } else{
                                            return <div className={'cars-wrap'} key={`p-${n}-${j}`}>{addCar(currentStep, dataArr[1])}</div>
                                        }
                                    }
                                })
                            )
                        } else if(steps[dataArr[0]]) {
                            currentStep = dataArr[0];

                            return <div key={`a-${j}`} className="wrap">

                                {dataArr[1][0].icon &&
                                <Icon
                                    icon={`${dataArr[1][0].icon}`}
                                    center="center"
                                    key={`b-${j}`}
                                />}

                                {dataArr[1][0].question &&
                                <Title
                                    title={`${dataArr[1][0].question}`}
                                    center="center"
                                    type={true}
                                    key={`c-${j}`}
                                />}

                                {dataArr[1][0].description &&
                                <Title
                                    title={`${dataArr[1][0].description}`}
                                    type={false}
                                    center="center"
                                    key={`d-${j}`}
                                />}

                                {(dataArr[1][0].quiz_type) === 'progress' &&
                                <ProgressBar
                                    progressData={`${dataArr[1][0].label_question}`}
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    center="center"
                                    key={`e-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'select' &&
                                <Select
                                    progressData={`${dataArr[1][0].label_question}`}
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    center="center"
                                    key={`f-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'checkbox' &&
                                <Checkbox
                                    progressData={`${dataArr[1][0].label_question}`}
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    center="center"
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    key={`g-${n}-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'input' &&
                                <Input
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    center="center" curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    custom={0} key={`h-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'radio' &&
                                <RadioBtn
                                    progressData={`${dataArr[1][0].label_question}`}
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    center="center"
                                    key={`k-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'switch' &&
                                <Switch
                                    progressData={`${dataArr[1][0].label_question}`}
                                    center="center"
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    key={`l-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].custom_field === 1) &&
                                <Input
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    center="center"
                                    custom={1}
                                    curentStep={currentStep}
                                    qty={`${dataArr[1][0].formula_qty}`}
                                    id={`${j}`}
                                    key={`m-${j}`}
                                    car={false}
                                    el={null}
                                    step={null}
                                />}

                                {(dataArr[1][0].quiz_type) === 'text' &&
                                <Text
                                    progressData={`${dataArr[1][0].label_question}`}
                                    unitMeasure={`${dataArr[1][0].unit_measure}`}
                                    center="center"
                                    key={`n-${j}`}
                                />}
                            </div>
                        }
                    })
                }

                {currentStep && <Arrow position="right" current={currentStep}/>}
                {currentStep && <Arrow position="left"  current={currentStep}/>}
                {showResultBtn && <Button center="center" current={currentStep}/>}
            </>
            )
        }}

        </Consumer>
        <footer>
            <div className="footer">
                <img src={footerLeft} className="footer-left-block"/>
                <img src={footerRight} className="footer-right-block"/>
            </div>
        </footer>
    </QuizWrapper>
    </div>
}

const QuizWrapper = styled.nav`
     background: #fbfdfc url(${bg});
     background-repeat: no-repeat;
     background-size: auto;
     background-position: top;
     min-width:100%;
     min-height:100%;
     padding:0;
     margin: 0;
     display: block;
     animation: fade_in_show 1s;
     transition: opacity 1s ease-out;

     footer{display:block;bottom: 0;width:100%;z-index:0;position:fixed;}
     .wrap{z-index:99999}
     .more-cars{
        position: relative;
        margin-top: 570px;
     }
     .footer{
         display:flex;
         justify-content:space-between;
         align-items: flex-end;
         position: relative;
     }
     .hidden,
     .hide{
         display:none!important;
         transition: .3s;
     }
     a{
        text-align:center;
        margin-bottom:55px;
        display: block;
     }
     .close-calculator{
        z-index: 999;
        background: #ffffff;
        padding: 18px 18px;
        border: 1px solid #ececec;
        border-radius: 50%;
        cursor: pointer;
        margin-top: 10px;
        box-shadow: 0 4px 0 0 #c8e6d1;
        height: 14px;
     }
    @keyframes fade_in_show {
        0% {
            opacity: 1;
            transform: scale(0)
        }

        100% {
            opacity: 1;
            transform: scale(1)
        }
    }
    .transport-cart-left,
    .transport-cart-right{
        display: inline-block;
        background: #FFFFFF;
        box-shadow: 0 10px 50px 0 rgb(17 153 142 / 10%);
        border-radius: 4px;
        margin: auto;
        border: 1px solid #B7EDED;
        padding: 0 47px;
        z-index:99999;
        margin-top: 140px;
        background-color: #fbfdfc;
    }
    .transport-cart-left{
        box-shadow: 15px 11px 3px -1px #cff5db;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        border-right: 1px solid #b7eded78;
        right:50%;
    }
    .transport-cart-right{
        box-shadow: 11px 12px 3px -2px #cff5db;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        border-left:none;
        left:50%;
    }
    .car-number{
        position: absolute;
        margin-top: -55px;
        margin-left: -76px;
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 16px;
    }
    .cars-wrap{
        position: relative;
        width: 963px;
        margin: 0 auto;
        text-align: center;
        margin-bottom: 200px;
    }
`;
