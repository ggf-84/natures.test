import React from 'react';

import InputLabel from "@material-ui/core/InputLabel";
import FormControl from "@material-ui/core/FormControl";
import {Select as CustomSelect} from "@material-ui/core";
import styled from "styled-components";
import {Consumer} from '../context'

export default function Select({progressData, unitMeasure, center, curentStep, qty}) {
    return <Consumer>
        {value => {
            const {handleSliderChange,disabledSlider} = value;
            const des = unitMeasure ==='cars' ?  false : disabledSlider[curentStep];

            return <SelectWrapper center={center} >
                <FormControl variant="outlined" className={'select'} disabled={des}>
                    <InputLabel >{unitMeasure}</InputLabel>
                    <CustomSelect native onChange={(e) => handleSliderChange(e, null, unitMeasure,
                                                                        curentStep, qty, null, false, false, null, null)} label="Age">
                        {
                            Object.entries(JSON.parse(progressData)).map((row, key, val) => {
                                return <option value={row[0] * 1000} key={key}>
                                    {`${row[1].title}` + ((row[1].description !== undefined) ?
                                        ` (${row[1].description})` : ``)}
                                </option>
                            })
                        }
                    </CustomSelect>
                </FormControl>
            </SelectWrapper>
        }}
    </Consumer>
}

const SelectWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    margin-top:40px;
    .select .MuiOutlinedInput-notchedOutline {
        border-color: #a4edbb;
    }
    .select .MuiSelect-select:focus {
        border-radius: 0;
        background-color: rgb(255 255 255);
    }
    .select .MuiFormLabel-root {
        font-size: 21px;
        font-family: IBM Plex Serif;
        font-weight: 400;
    }
    .select .MuiSelect-outlined.MuiSelect-outlined {
        padding-right: 31px;
        padding-left: 31px;
    }
    .select .MuiInputLabel-outlined.MuiInputLabel-shrink {
        transform: translate(8px, -9px) scale(0.70);
        text-transform: capitalize;
        color: #000;
        font-family: IBM Plex Serif;
        font-weight: 400;
    }

`;
