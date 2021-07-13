import React from 'react';
import { Switch as Switcher } from '@material-ui/core';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Typography from '@material-ui/core/Typography';
import styled from "styled-components";
import { Consumer } from "../context"

export default function Switch({progressData, center, unitMeasure, curentStep, qty}) {

    return <Consumer>

        {value => {
            const {handleSliderChange, disabledSlider} = value;
            const des = unitMeasure ==='cars' ?  false : disabledSlider[curentStep];
            const updateSwitchData = (data) => {

                const dataObj = Object.fromEntries(
                    Object.entries(JSON.parse(data)).sort(([,a],[,b]) => a-b)
                );

                const dataVal = Object.values(dataObj)
                const dataKey = Object.keys(dataObj)
                const max = dataVal[parseInt(dataVal.length) - 1]

                return {
                    progressData: dataObj,
                    progressMin: dataVal[0],
                    progressMax: max,
                    progressMinLabel: dataKey[0],
                    progressMaxLabel: dataKey[parseInt(dataKey.length) - 1],
                }
            }

            const data = updateSwitchData(progressData);

            return <SwitchWrapper center={center}>
                <div className="switch">
                    <Typography className="start">{data.progressMin.title}</Typography>
                    <FormControlLabel
                        onChange={(e) => handleSliderChange(e, null, unitMeasure, curentStep, qty, data.progressMaxLabel, 'switch', false, null, null)}
                        control={<Switcher  color={'primary'} />}
                        className="label"
                        disabled={des}
                    />
                    <Typography className="end">{data.progressMax.title}</Typography>
                </div>
            </SwitchWrapper>
        }}
    </Consumer>
}

const SwitchWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    z-index: 99999;
    .switch{
        display: flex;
        align-items: center;
    }
    .start, .end {
        width: -webkit-fill-available;
        font-size: 16px;
        font-family: IBM Plex Serif;
        font-weight: 400;
    }
    .start{ text-align: end;}
    .end{ text-align: left;}
    .label{margin:0}
    .MuiSwitch-colorPrimary.Mui-checked {
        color: #2db09d;
    }
    .MuiSwitch-colorPrimary.Mui-checked + .MuiSwitch-track {
        background-color: #52d5ab;
    }
    .MuiSwitch-colorPrimary.Mui-disabled{
        color: #bdbdbd!important;
    }
`;
