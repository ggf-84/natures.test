import React from 'react';

import RadioGroup from '@material-ui/core/RadioGroup';
import Radio from '@material-ui/core/Radio';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import styled from "styled-components";
import {Consumer} from '../context'

export default function RadioBtn({progressData, unitMeasure, center, curentStep, el, step, qty, car}){

    return <Consumer>

        {value => {
            const {progressLabel, progressValue, handleSliderChange, radioValue, disabledSlider} = value;
            const dis = (el && step) ? disabledSlider[curentStep][el][step] : disabledSlider[curentStep];

            return <RadioBtnWrapper center={center} >
                <RadioGroup className="radio-group" onChange={(e) => handleSliderChange(e, null, unitMeasure, curentStep, qty, null, false, car, el, step)}>
                {
                    Object.entries(JSON.parse(progressData)).map((row, key, val) => {
                        return <FormControlLabel
                            value={`${row[0] * 1000}`}
                            disabled={dis}
                            control={<Radio color="primary" />}
                            label={`${row[1].title}` + ((row[1].description !== undefined) ? ` (${row[1].description})` : ``)}
                            key={key}
                        />
                    })
                }
                </RadioGroup>
            </RadioBtnWrapper>
        }}
    </Consumer>

}

const RadioBtnWrapper = styled.nav`
    margin:${props => props.center ? "0 auto" : "0"};
    margin-left:15px;
    .radio-group{
        display: grid;
        width: fit-content;
        margin: ${props => props.center ? "0 auto" : "0"};
        z-index: 99999;
    }
    .MuiRadio-colorPrimary.Mui-checked {
        color: #16A398;
    }
    .PrivateSwitchBase-root-84 {
        padding: 4px;
    }
    .MuiSvgIcon-root {
        width: 19px;
        height: 19px;
    }
    .MuiRadio-root {
        color: dedede;
    }
    .MuiTypography-body1 {
        font-family: IBM Plex Sans;
        font-weight: 400;
        font-size: 14px;
        letter-spacing: 0;
    }
    .MuiFormControlLabel-root {
        margin-left: -8px;
        margin-bottom:2px
    }
    .MuiRadio-colorPrimary.Mui-disabled{
        color: #bdbdbd!important;
    }
`;
