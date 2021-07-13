import React from 'react';
import FormControlLabel from "@material-ui/core/FormControlLabel";
import styled from "styled-components";
import CheckBoxOutlineBlankIcon from '@material-ui/icons/CheckBoxOutlineBlank';
import CheckBoxIcon from '@material-ui/icons/CheckBox';
import {Consumer} from '../context'

export default function Checkbox({progressData,center, unitMeasure, curentStep, qty}) {

    return <Consumer>
        {value => {
            const {GreenCheckbox, radioValue, handleSliderChange} = value;
            const d = Object.entries(JSON.parse(progressData));

            return <CheckboxWrapper center={center}>
                    <FormControlLabel
                        control={
                            <GreenCheckbox onChange={(e) => handleSliderChange(e, null,
                                                    unitMeasure, curentStep, qty, null, false, false, null, null)}
                                icon={<CheckBoxOutlineBlankIcon fontSize="small" />}
                                checkedIcon={<CheckBoxIcon fontSize="small" />}
                                value={d[0][0]}
                            />
                        }
                        label={d[0][1].title}
                    />
            </CheckboxWrapper>
        }}
        </Consumer>
}

const CheckboxWrapper = styled.nav`
    z-index: 99999;
    text-align:${props => props.center ? "center" : "left"};
    .MuiTypography-body1{
        font-family: IBM Plex Sans;
        font-size: 14px;
        font-weight: 400;
    }
    .form{ display: inline-flex; align-items: flex-end; }
    .unit-measure{ margin-left:10px}
`;
