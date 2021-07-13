import React from 'react';
import styled from 'styled-components'

export default function Title({title, center, type, transport}) {
    return (
        <TitleWrapper center={center}>
            <div className="col">
                {type && <h2 className={transport ? "text-title transport" : "text-title"}>{title}</h2>}
                {!type && <h3 className="text-description">{title}</h3>}
            </div>
        </TitleWrapper>
    )

}

const TitleWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    z-index: 99999;
    margin-top: 25px;
    margin-bottom: 5px;
    .text-title{
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 40px;
        color: #000000;
        padding-top:15px;
        max-width: 715px;
        margin: 0 auto;
        line-height: 52px;
        min-height:105px;
    }
    .text-description{
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 16px;
        color: #000000;
        max-width: 715px;
        margin: 0 auto;
        min-height:21px;
    }
    .transport{
        font-size:14px;
        font-family: IBM Plex Sans;
        font-weight: 400;
        min-height:0;
        line-height: 0;
        padding-top:45px;
        padding-bottom:24px;
        max-width: initial;
        margin-left:15px;
    }
`;
