import React from 'react';
import TextField from '@material-ui/core/TextField';
import styled from "styled-components";
import {Consumer} from '../context'

export default function Input({unitMeasure, center, custom, id, car, qty, curentStep, el, step}) {

    return <Consumer>

        {value => {
            const {handleChange,inputLabel} = value;
            var label = unitMeasure;

            if(unitMeasure === 'mpg') {
                if(!inputLabel[`input-${id}-state`]) {
                    label = `1 gallon = ${qty} tonnes CO2`;
                }
                if(inputLabel[`input-${id}-state`]) {
                    label = `${inputLabel[`input-${id}-state`]} ${unitMeasure} =
                    ${ (235.21 / inputLabel[`input-${id}-state`]).toFixed(2) } L/100km`;
                }
            }

            if(unitMeasure === 'miles') {
                if(inputLabel[`input-${id}-state`]) {
                    label = `${inputLabel[`input-${id}-state`]} ${unitMeasure} =
                    ${ (inputLabel[`input-${id}-state`] * 1.609).toFixed(2) } km`;
                }
            }

            if(unitMeasure === 'kwh') {
                label = `1 ${unitMeasure} = ${qty} tonnes CO2`;
            }

            return <InputWrapper center={center} car={car}>
                <div className="custom-label">Or enter actual {unitMeasure} used</div>
                <form className="form" noValidate autoComplete="off">
                    <TextField id={`input-${id}`} type="number" label={label} custom={custom}
                               onChange={(e) => handleChange(e, unitMeasure, curentStep, el, step, qty, car)}/>
                </form>
            </InputWrapper>
        }}
    </Consumer>
}

const InputWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    margin-left:15px;
    margin-top:${props => props.car === true ? 0 : "100px"};
    .form{
        display: inline-flex;
        align-items: flex-end;
        margin-bottom:60px;
        z-index:99999;
        margin-top: ${props => props.car ? 0 : "20px"};
    }
    .unit-measure{ margin-left:10px}
    .custom-label{
        font-family:${props => props.car === true ? "IBM Plex Sans" : "IBM Plex Serif"};
        font-size: ${props => props.car === true ? "14px" : "16px"};
        font-weight: 500;
        font-weight: ${props => props.car === true ? 500 : 400};
        color: #000000;
        text-align: ${props => props.center ? "center" : "left"};
        line-height: 6px;
        margin: 30px 0 18px 0;
    }
    label + .MuiInput-formControl {
        width: 342px;
        height: 60px;
        border: 1px solid #B7EDED;
        border-radius: 2px;
        pointer-events: none;
        padding: 14px 37px;
        box-shadow: 0 4px 0 0 rgb(164 237 187 / 25%);
        background-color: #fff;
    }
    .MuiInputLabel-formControl {
        cursor: pointer;
        left: 42;
        top: -17px;
        padding-top: 31px;
        color: #9A9A9A;
        text-align: left;
        z-index: 99;
        height: 47px;
        width: 342px;
    }
    .MuiFormLabel-filled, .MuiFormLabel-root.Mui-focused {
        color: #9A9A9A;
        left: 0;
        height: 90px;
        width: 457px;
        padding-top: 18px;
        font-size: 19px;
    }
    .MuiInput-underline:after {
        border-bottom: 2px solid #16A398;
    }
    .MuiInput-underline:before {
        border-bottom: 1px solid #b7eded;
    }
    .MuiFormControl-root {
        z-index: 99999;
    }
`;
