import React, { Component } from 'react';
import styled from 'styled-components'
import bus from "../assets/img/bus.svg"
import car from "../assets/img/car.svg"
import electricity from "../assets/img/electricity.svg"
import man from "../assets/img/man.svg"
import wallet from "../assets/img/wallet.svg"
import plane from "../assets/img/plane.svg"
import gas from "../assets/img/gas.svg"
import food from "../assets/img/food.svg"

export default function Icon({center, icon}){
    var image = false;

    if ( icon === 'bus' ) image = bus;
    else if ( icon === 'car' ) image = car;
    else if ( icon === 'man' ) image = man;
    else if ( icon === 'gas' ) image = gas;
    else if ( icon === 'food' ) image = food;
    else if ( icon === 'plane' ) image = plane;
    else if ( icon === 'wallet' ) image = wallet;
    else if ( icon === 'electricity' ) image = electricity;

    return <>
        {image && <IconWrapper center={center}>
            <img src={image} alt="logo" className="icon"/>
        </IconWrapper>}
    </>


}

const IconWrapper = styled.nav`
    text-align:${props => props.center ? "center" : "left"};
    margin-top: 25px;
    margin-bottom: 5px;
`;
