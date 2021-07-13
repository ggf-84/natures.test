import React from 'react';
import Typography from '@material-ui/core/Typography';
import Slider from '@material-ui/core/Slider';
import styled from "styled-components";
import {Consumer} from '../context'

export default function ProgressBar({progressData, unitMeasure, width, center, curentStep, qty}) {

    return <Consumer>

        {value => {
            const {PrettySlider, handleSliderChange, progressLabel, progressValue, progressDesc, convertTo, disabledSlider} = value;
            const des = unitMeasure ==='cars' ?  false : disabledSlider[curentStep];

            const updateProgressBarData = (data) => {

                const sortObject = data => Object.keys(data).sort().reduce((res, key) => (res[(key * 1000)] = data[key], res), {});
                const dataObj   = sortObject(data);
                const dataVal   = Object.values(dataObj)
                const dataKey   = Object.keys(dataObj)
                const max       = parseInt(dataKey[parseInt(dataKey.length) - 1])

                return {
                    progressData:           dataObj,
                    progressMin:            parseInt(dataKey[0]),
                    progressMax:            max,
                    progressStep:           parseInt(dataKey[1]),
                    progressDefault:        parseInt(dataKey[1]),
                    progressMinLabel:       dataObj[dataKey[0]].title,
                    progressMaxLabel:       dataObj[dataKey[parseInt(dataKey.length) - 1]].title,
                    progressDefaultLabel:   dataObj[dataKey[1]].title,
                    progressDefaultDesc:   (dataObj[dataKey[1]].description !== undefined) ? dataObj[dataKey[1]].description : '',
                }
            }

            const data = updateProgressBarData(JSON.parse(progressData));

            return (<>
                <ProgressBarWrapper width={width} center={center}>
                    <div className="labels">

                        <Typography className="label">{
                            ['hours','miles'].includes(unitMeasure) ?
                                (progressLabel === false ? convertTo(data.progressDefault, unitMeasure) : progressLabel ) :
                                (progressLabel === false ? (data.progressDefaultLabel) : progressLabel )
                        } </Typography>
                        <Typography className="description">{ progressDesc === false ? data.progressDefaultDesc : progressDesc } </Typography>

                    </div>
                    <div className="slider">
                        <Typography className="start">{data.progressMinLabel}</Typography>
                        <PrettySlider
                            className="margin"
                            defaultValue={data.progressDefault}
                            min={data.progressMin }
                            max={data.progressMax}
                            aria-labelledby={"continuous-slider"}
                            disabled={des}
                            valueLabelDisplay="off"
                            onChangeCommitted={(e) => handleSliderChange(e, data.progressData, unitMeasure, curentStep, qty, null, false, false, null, null)}
                            onChange={(e) => handleSliderChange(e, data.progressData, unitMeasure, curentStep, qty, null, false, false, null, null)}
                        />
                        <Typography className="end">{data.progressMaxLabel}</Typography>
                    </div>
                </ProgressBarWrapper>
            </>)
        }}
    </Consumer>
}

const ProgressBarWrapper = styled.nav`
    z-index: 99999;
    width:${props => props.width};
    margin:${props => props.center ? "25px auto" : "left"};
    margin-top: 60px;
    .start, .end {
        width: -webkit-fill-available;
        font-size: 16px;
        font-family: IBM Plex Serif;
        font-weight: 400;
    }
    .start{ text-align: end;}
    .end{ text-align: left;}
    .slider{
        display: flex;
        align-items: center;
            margin-top: 34px;
    }
    .labels{
        display: block;
        text-align: center;
    }
    .margin{ margin: 0 35px;}
    .value{ margin-top: 5px; font-size: 14px;}
    .label{
        background-image: linear-gradient(180deg,#ffffff 30%, #a4edbbbf 100%);
        font-size: 21px;
        font-family: IBM Plex Serif;
        font-weight: 500;
        color: #000000;
        text-align: center;
        line-height: 34px;
        padding: 0px 5px;
        width: fit-content;
        margin: 8px auto;
        border-radius: 1px;
    }
    .description{
        font-family: IBM Plex Serif;
        font-size: 14px;
        font-weight: 400;
        color: #000000;
        text-align: center;
        min-height:21px;
    }
    .MuiSlider-thumb.Mui-disabled{
        color: #bdbdbd;
        width: 31px;
        border: 4px solid currentColor;
        height: 31px;
        margin-top: -14px;
        margin-left: -12px;
    }
`;
