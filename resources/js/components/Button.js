import React from 'react';
import styled from "styled-components";
import { Consumer } from "../context"

export default function Button({center, current}) {
    return <Consumer>
        {value => {
            const {getResult} = value;

            return <ButtonWrapper center={center}>
                <button className="btn-result" onClick={() => getResult(current)}> calculate</button>
            </ButtonWrapper>
        }}
    </Consumer>
}

const ButtonWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    z-index: 99999;
    padding-top: 50px;
    .btn-result{
        background-image: linear-gradient(45deg, #16A398 0%, #52D5AB 100%);
        border-radius: 30px;
        font-family: IBM Plex Sans;
        font-weight: 400;
        font-size: 14px;
        color: #FFFFFF;
        text-align: center;
        padding: 21px 48px;
        border: none;
        cursor:pointer;
        z-index: 999999;
        position: relative;
    }
`;
