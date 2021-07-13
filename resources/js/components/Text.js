import React from 'react';
import Typography from '@material-ui/core/Typography';
import styled from "styled-components";

export default function Text({progressData, unitMeasure, center, custom}) {

    const d = Object.entries(JSON.parse(progressData));
    // console.log(d[0][0], d[0][1].title)

    return <TextWrapper center={center}>
            <Typography className="label">{ d[0][0] } { unitMeasure }</Typography>
            <Typography className="description">{ d[0][1].title } </Typography>
        </TextWrapper>
}

const TextWrapper = styled.nav`
    z-index: 99999;
    width:${props => props.width};
    margin:${props => props.center ? "60px auto" : "left"};
    display: block;
    text-align: center;
    .label{
        background-image: linear-gradient(180deg,#ffffff 30%, #a4edbbbf 100%);
        font-family: IBM Plex Serif;
        font-weight: 500;
        font-size: 21px;
        color: #000000;
        text-align: center;
        line-height: 28px;
        padding: 0px 10px;
        width: fit-content;
        margin: 8px auto;
    }
    .description{
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 16px;
        color: #000000;
        text-align: center;
        margin: 0 auto;
        margin-top: 40px;
        line-height: 32px;
        width: 510px;
    }
`;
