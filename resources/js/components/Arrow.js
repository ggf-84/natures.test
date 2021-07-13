import React from 'react';
import { NavigateNext, NavigateBefore } from '@material-ui/icons';
import styled from "styled-components";
import ArrowRight from "../assets/img/arrow.svg"
import ArrowLeft from "../assets/img/arrow_left.svg"
import {Consumer} from '../context'

export default function Arrow({position, current}) {

    return <Consumer>
        {value => {
            const {radioValue, navigateBack, navigateNext, showBeforeArr, showNextArr} = value;

            return <ArrowWrapper>
                {position === "left" && showBeforeArr && <img className="left" src={ArrowLeft} onClick={() => navigateBack(current)} />}
                {position === "right" && showNextArr && <img className="right" src={ArrowRight} onClick={() => navigateNext(current)} />}
            </ArrowWrapper>
        }}
    </Consumer>
}

const ArrowWrapper = styled.nav`
    z-index: 99999;
    .left, .right{
        z-index: 999;
        background: #ffffff;
        padding: 23px 13px;
        border: 1px solid #ececec;
        border-radius: 50%;
        cursor: pointer;
        top: 435px;
        position: absolute;
        box-shadow: 0 4px 0 0 #c8e6d1;
    }
    .left{
        left: 140px;
    }
    .right{
        right: 140px;
    }
`;
