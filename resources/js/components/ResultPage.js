import React from 'react';
import Title from './Title'
import Icon from './Icon'
import styled from "styled-components";
import bg from "../assets/img/res-bg.png"
import bgSpunge from "../assets/img/bg.png"
import close from "../assets/img/close.svg"
import { Consumer } from "../context"

export default function ResultPage(){
    return <ResultWrapper>
        <Consumer>
            {value => {
                const {totalCo2, resetCalculator, resultInfo} = value;
                const averageList = []
                averageList.push(totalCo2);
                var i = totalCo2;
                Object.values(resultInfo.compare_co2_emission).map((item) => {
                    if(parseFloat(item) > i) i = parseFloat(item);
                })

                return<div className={'result-info'}>
                    <a href="/">
                        <img src={close} className="close-calculator"/>
                    </a>
                    <div className={`first-block`}>
                        <div className={'title'}>{resultInfo.main_title_block_1}</div>
                        <div className="label-co2">{totalCo2} {resultInfo.tonnes}</div>
                        <div className={'description'}>
                            {resultInfo.description_block_1}
                        </div>
                        <div className="label-trees">{parseInt(totalCo2 / 0.33)} {resultInfo.trees}</div>
                        <button className="btn-result" onClick={() => resetCalculator()}>{resultInfo.offset_footprint}</button>
                        <a className="n-leap">
                            <span className="n-leap-label">Discover</span>
                            <span className="n-leap-icon">⇀</span>
                        </a>
                    </div>
                    <div className={`second-block`}>
                        <div className={'title'}>{resultInfo.main_title_block_2}</div>
                        <div className={'compare'}>
                            <div className={'range-list'}>
                                <div className={'name first'}>You</div>
                                <div className={'range'} style={{width: i === totalCo2 ? `650px` : `${650 / (100/ ((100 / i) * totalCo2))}`}}></div>
                                <span className={'first'}>{totalCo2}</span>
                            </div>
                            {
                                Object.entries(resultInfo.compare_co2_emission).map((item, key) => {
                                    return <div className={'range-list'} key={key}>
                                        <div className={'name'}>{item[0]}</div>
                                        <div className={'range'} style={{width: i === parseFloat(item[1]) ? `650px` : `${650 / (100 / ((100 / i) * parseFloat(item[1])))}`}}></div>
                                        <span>{item[1]}</span>
                                    </div>
                                })
                            }
                        </div>
                    </div>
                    <div className={`third-block`}>
                        <div className={'title'}>{resultInfo.main_title_block_3}</div>
                        <div className={'description'}>
                            {resultInfo.description_block_3}
                        </div>

                        <div className={'wrap'}>
                            <div className={'block-3'}>
                                <Icon icon={`electricity`} center={false} />
                                <div className={'title'}>{resultInfo.title_block_3_a}</div>
                                <div className={'description'}>{resultInfo.description_block_3_a}</div>
                                <div className={'label'}>{resultInfo.label_block_3_a}</div>
                            </div>

                            <div className={'block-3'}>
                                <Icon icon={`food`} center={false} />
                                <div className={'title'}>{resultInfo.title_block_3_b}</div>
                                <div className={'description'}>{resultInfo.description_block_3_b}</div>
                                <div className={'label'}>{resultInfo.label_block_3_b}</div>
                            </div>

                            <div className={'block-3'}>
                                <Icon icon={`wallet`} center={false} />
                                <div className={'title'}>{resultInfo.title_block_3_c}</div>
                                <div className={'description'}>{resultInfo.description_block_3_c}</div>
                                <div className={'label'}>{resultInfo.label_block_3_c}</div>
                            </div>

                            <div className={'block-3'}>
                                <Icon icon={`bus`} center={false} />
                                <div className={'title'}>{resultInfo.title_block_3_d}</div>
                                <div className={'description'}>{resultInfo.description_block_3_d}</div>
                                <div className={'label'}>{resultInfo.label_block_3_d}</div>
                            </div>
                        </div>

                    </div>
                </div>
            }}
        </Consumer>
    </ResultWrapper>
}

const ResultWrapper = styled.nav`
     background-color: #fbfdfc;
     min-width:100%;
     min-height:100%;
     padding:0;
     margin: 0;
     display: block;
     animation: fade_in_show 1s;
     transition: opacity 1s ease-out;
     .first-block .title{
        max-width: 510px;
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 40px;
        color: #000000;
     }
     .first-block .description, .third-block .description{
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 16px;
        color: #000000;
        max-width: 515px;
        min-height:21px;
        line-height: 34px;
        padding-left: 15px;
     }
     .first-block .label-co2, .first-block .label-trees{
        background-image: linear-gradient(180deg,#ffffff 30%, #a4edbbbf 100%);
        font-size: 52px;
        font-family: IBM Plex Serif;
        font-weight: 500;
        color: #000000;
        text-align: center;
        padding: 0px 5px;
        width: fit-content;
        border-radius: 1px;
        margin-top: 30px;
        margin-bottom: 40px;
    }
    .first-block .label-trees{
        margin-top: 16px;
        font-size: 32px;
    }
     .first-block{
        max-width: 925px;
        margin: 0px auto;
        padding: 135px 0 310px;
        text-align: left;
     }
     .result-info{
         background: #fbfdfc url(${bg});
         background-repeat: no-repeat;
         background-size: auto;
         background-position: top;
         min-width:100%;
         min-height:100%;
     }
     .first-block .btn-result{
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
        margin-top: 10px;
    }
     a{
        text-align:center;
        margin-bottom:55px;
        display: block;
     }
     .close-calculator{
        z-index: 999;
        background: #ffffff;
        padding: 18px 18px;
        border: 1px solid #ececec;
        border-radius: 50%;
        cursor: pointer;
        margin-top: 10px;
        box-shadow: 0 4px 0 0 #c8e6d1;
        height: 14px;
     }
    .n-leap {
        align-items: center;
        display: none;
        font-size: 0.625rem;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        line-height: 1;
        transform: rotate( -90deg) translateX(100%) translateY(100%);
        z-index: 100;
        position: absolute;
        right: 30px;
        bottom: 0;
        margin-bottom: 0.5rem;
        font-family: IBM Plex Serif;
        font-weight: 500;
        color: #000;
        text-decoration: none;
        background-color: transparent;
    }
    .n-leap-icon {
        font-size: 1.3rem;
        padding-left: 1rem;
        transform: rotate(180deg);
        order: 1;
    }
    .n-leap-label {
        order: 2;
    }
    @media (min-width: 768px){
        .n-leap {
            display: flex!important;
        }
    }

    .second-block, .third-block {
        background: #fbfdfc url(${bgSpunge});
        background-repeat: no-repeat;
        background-size: auto;
        background-position: top;
        min-width: 100%;
    }
    .second-block .title, .third-block .title{
        font-family: IBM Plex Serif;
        font-weight: 400;
        font-size: 40px;
        color: #000000;
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
     }
     .second-block .compare {
        margin: 0 auto;
        margin-top: 80px;
        margin-bottom: 140px;
        width: 925px;
     }
     .second-block .range-list {
        display: flex;
        justify-content: normal;
        margin-bottom: 25px;
     }
     .second-block .range-list .name{
        width: 200px;
        font-family: IBM Plex Sans;
        font-weight: 400;
        font-size: 21px;
     }
     .second-block .range-list span{
        font-family: IBM Plex Sans;
        font-weight: 400;
        font-size: 16px;
     }
     .second-block .range-list .first{
        font-weight: 500;
     }
     .second-block .range{
        background-image: linear-gradient(45deg,#a4edbb 0%,#8ff0f0 100%);
        border-radius: 30px;
        height: 15px;
        margin-right: 15px;
        margin-top: 3px;
     }
     .third-block {
        background-size: contain;
        margin-bottom: 180px;
     }
     .third-block .description{
        margin:25px auto;
        text-align:center;
     }

    .third-block .wrap {
        max-width: 930px;
        margin: 0 auto;
    }

    .third-block .wrap .block-3{
        display: inline-block;
        background: #FFFFFF;
        box-shadow: 0 10px 50px 0 rgb(17 153 142 / 10%);
        border-radius: 4px;
        border: 1px solid #B7EDED;
        padding: 0 47px;
        z-index:99999;
        margin-top: 50px;
        background-color: #fbfdfc;
        box-shadow: 13px 13px 3px -1px #cff5db;
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
        border-right: 1px solid #b7eded78;
        width: 349px;
        padding-top: 25px;
        padding-bottom: 56px;
    }
    .third-block .wrap .block-3 .title{
        font-family: IBM Plex Serif;
        font-weight: 500;
        font-size: 21px;
        text-align: left;
        width: 240px;
        margin: 28px 0;
        height: 56px;
    }
    .third-block .wrap .block-3 .description, .third-block .wrap .block-3 .label{
        font-family: IBM Plex Sans;
        font-weight: 400;
        font-size: 16px;
        margin:0;
        text-align: left;
        padding-left:0;
    }
    .third-block .wrap .block-3 .description{
        line-height:30px;
    }
    .third-block .wrap .block-3 .label{
        font-weight: 500;
        margin-top:12px;
        background-image: linear-gradient(180deg,#ffffff 30%, #a4edbbbf 100%);
        width: fit-content;
        padding: 0px 2px;
    }
    .third-block .wrap > *:nth-child(2n + 1){
      margin-right: 30px;
    }
`;
