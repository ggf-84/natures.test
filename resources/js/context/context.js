import React, { Component } from 'react'
import { withStyles, makeStyles } from '@material-ui/core/styles';
import Slider from '@material-ui/core/Slider';
import Title from '../components/Title';
import RadioBtn from '../components/RadioBtn';
import Input from '../components/Input';
import {Checkbox as Chbox} from "@material-ui/core";
import axios from 'axios'

const Context = React.createContext();

class Provider extends Component{
    state = {
        data: {},
        loaded: false,
        progressLabel: false,
        progressValue: false,
        progressDesc: false,
        radioValue: null,
        checkedVal: 0,
        result: 0,
        steps: {},
        showBeforeArr: false,
        showNextArr: true,
        showResultBtn: false,
        showResultPage: false,
        currentKey: false,
        result: {},
        moreCars: [],
        nrOfCars: 0,
        inputLabel: {},
        disabledSlider:{},
        totalCo2: 0,
        resultInfo: {},
        storeCustominput: {}
    }

    async componentDidMount(){
        await this.loadData()

        if(this.state.data.length > 0){
            var keys = [],
                steps = {},
                disabled = [],
                result = [];

            this.state.data.map((item, dataArr) => {
                keys.push(item[0])

                if(item[1].length > 1 && item[1][0].unit_measure === 'cars'){
                    disabled[item[0]] = []
                    result[item[0]] = []

                    for (var i = 1; i <= 7; i++) {
                        disabled[item[0]][i]    = []
                        disabled[item[0]][i][1] = false
                        disabled[item[0]][i][2] = false

                        result[item[0]][i]      = []
                        result[item[0]][i][1]   = null
                        result[item[0]][i][2]   = null
                    }
                }else if(item[1].length === 1){
                    disabled[item[0]] = false

                    var val = Object.keys(JSON.parse(item[1][0].label_question)).length > 1 ?
                        Object.keys(JSON.parse(item[1][0].label_question))[1] :
                        Object.keys(JSON.parse(item[1][0].label_question))[0];

                    val =  ['radio'].includes(item[1][0].quiz_type) ? 0 : val * item[1][0].formula_qty;

                    result[item[0]] = val

                }else{
                    disabled[item[0]] = false

                    var arr = []
                    Object.values(item[1]).map((element, key) => {
                        var val = Object.keys(JSON.parse(element.label_question)).length > 1 ?
                            Object.keys(JSON.parse(element.label_question))[1] :
                            Object.keys(JSON.parse(element.label_question))[0];

                        val =  ['checkbox', 'radio'].includes(element.quiz_type) ? 0 : val * element.formula_qty;

                        arr.push(val)
                    })

                    result[item[0]] = arr;
                }
            })

            for(var i = 0; i < keys.length; i++){
                steps[keys[i]] = i > 0 ? false : true
            }

            localStorage.setItem('initialResult', JSON.stringify(result));
            localStorage.setItem('initialDisabledSlider', JSON.stringify(disabled));
            localStorage.setItem('storeCustominput', JSON.stringify(result));

            this.setState({
                steps: steps,
                loaded: true,
                disabledSlider: disabled,
                result: result
            })

            // console.log('mounting')
        }
    }

    getResult = (current) => {
        var res = []
        this.state.result.map((item) => {
            if(Array.isArray(item) && item.length > 0){
                item.map((element) => {
                    if(Array.isArray(element) && element.length > 0){
                        if(element[1] > 0 && element[2] > 0){
                            console.log('car', element[1],element[2])
                            let nr = (element[2] / element[1]) * 0.0143;
                            res.push(nr)
                        }

                        // element.map((el) => {
                        //     if(el) res.push(el);
                        // })
                    }else{
                        if(element) res.push(element);
                    }
                })
            }
            else{
                if(item) res.push(item);
            }
        })

        this.setState({totalCo2: eval(res.join('+')).toFixed(2), showResultPage: true, currentKey: 0})
    }

     loadData = async () => {
        let self = this
        await axios.get(`/api/get-data`)
            .then(function (response) {
                self.setState({
                    data: Object.entries(response.data.data),
                    resultInfo: response.data.result
                })
            }).catch(function (error) {
                console.error(error);
            });
    }

    calculateResult = (data) => {

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
            progressDefault: dataVal[1],
            progressMinLabel: dataKey[0],
            progressMaxLabel: dataKey[parseInt(dataKey.length) - 1],
            progressDefaultLabel: dataKey[1],
        }
    }

    resetCalculator = () => {
        this.setState({data: {},
            loaded: false,
            progressLabel: false,
            progressValue: false,
            progressDesc: false,
            radioValue: null,
            checkedVal: 0,
            result: 0,
            steps: {},
            showBeforeArr: false,
            showNextArr: true,
            showResultBtn: false,
            showResultPage: false,
            currentKey: false,
            result: {},
            moreCars: [],
            nrOfCars: 0,
            inputLabel: {},
            disabledSlider:{},
            totalCo2: 0,
            resultInfo: {},
            storeCustominput: {}
        });
        localStorage.removeItem('initialResult');
        localStorage.removeItem('initialDisabledSlider');
        localStorage.removeItem('storeCustominput');
        this.componentDidMount()
    }

    handleSliderChange = async (e, data,unit, step, qty, switchVal, type, car, el, stp ) => {
        var slider = document.getElementsByClassName('MuiSlider-thumb');
        var val = null

        if(slider && slider.length > 0) { val = slider[0].getAttribute('aria-valuenow'); }

        val = ['select-one','radio','checkbox'].includes(e.target.type) ? parseFloat(e.target.value) : parseFloat(val);

        if(type === 'switch'){
            val = e.target.checked ? parseFloat(switchVal) : 0;
        }else if(e.target.type === 'checkbox' && !e.target.checked){
            val = 0
        }

        var i = 1;
        var j = 0
        var st = {};
        var res = this.state.result;

        if(!isNaN(val)){
            if(unit === 'cars'){
                val = (Math.round((val / 1000)));
                i = 1000;
                j = 0.5;
            }
            if(data){
                Object.entries(data).map((value, key, obj) => {
                    if(val >= parseInt(value[0] / i) /*&& val !== j*/){
                        st = {
                            progressValue: value[0],
                            progressLabel:  ['hours','miles'].includes(unit) ? this.convertTo(val,unit) : value[1].title,
                            progressDesc:  value[1].description !== undefined ? value[1].description : false
                        }
                    }
                })
            }

            this.setState(st);

            if(unit === 'cars' && [0,1,2,3,4,5,6,7].includes(val)){
                for(let key = 1; key <= 7; key++){
                    let trLeft = document.getElementById("transport-"+key+"-1");
                    let trRight = document.getElementById("transport-"+key+"-2");
                    trLeft.classList.add('hide');
                    trRight.classList.add('hide');
                }

                if(val > 0 ){
                    for(let key = 1; key <= val; key++){
                        let trLeft = document.getElementById("transport-"+key+"-1");
                        let trRight = document.getElementById("transport-"+key+"-2");
                        trLeft.classList.remove('hide');
                        trRight.classList.remove('hide');
                    }
                }
            }else{
                if(car && el && stp){
                    res[step][el][stp] = val / 1000
                }else{
                    if(Array.isArray(res[step]) && res[step].length > 0){
                        if(['checkbox'].includes(e.target.type)) res[step][res[step].length - 1] = (val * qty);
                        else res[step][0] = (val / 1000) * qty;
                    }else{
                        res[step] = ['checkbox'].includes(e.target.type) ? (val * qty) : ((val / 1000) * qty)
                    }
                }

               this.setState({result: res })
            }
            localStorage.setItem('storeCustominput', JSON.stringify(res))
        }
        console.log('res', this.state.result)
    };

    handleChange = (e, measure, currentStep, el, step, qty, car) => {
        const inputId = e.target.id;
        const ids = this.state.inputLabel;
        const disable = this.state.disabledSlider;

        if (e.target && e.target.value > 0) {
            ids[`${inputId}-state`] = parseInt(e.target.value);
            if(el && step) disable[currentStep][el][step] = true;
            else disable[currentStep] = true;
        } else if(e.target && e.target.value === '') {
            ids[`${inputId}-state`] = false
            if(el && step){
                disable[currentStep][el][step] = false;
            }else{
                disable[currentStep] = false;
            }
        }

        if (e.target && e.target.value && ['miles', 'mpg'].includes(measure)) this.setState({disabledSlider: disable, inputLabel: ids});

        var res = this.state.result;
        if (e.target && !isNaN(e.target.value)) {


            if(car && el && step){
                res[currentStep][el][step] = parseFloat(e.target.value)
            }else {
                if (Array.isArray(res[currentStep]) && res[currentStep].length > 0) {
                    res[currentStep][0] = parseFloat(e.target.value) * qty;
                } else {
                    res[currentStep] = parseFloat(e.target.value) * qty
                }
            }
            this.setState({result: res})
        }
        if(e.target.value === ''){
            var store = JSON.parse(localStorage.getItem('storeCustominput'))

            if(car && el && step){
                res[currentStep][el][step] = store[currentStep][el][step];
            }else {
                if (Array.isArray(res[currentStep]) && res[currentStep].length > 0) {
                    res[currentStep][0] = store[currentStep][0];
                } else {
                    res[currentStep] = store[currentStep];
                }
            }
            this.setState({result: res})
        }
        console.log('inp', this.state.result)
        this.updateCurrent(currentStep)
    }

    // handleRadioChange = async (e) => {
    //     await this.setState({
    //         radioValue: e.target.value
    //     })
    // }

    updateCurrent = async (current) => {
        await this.setState({currentKey: current});
        const steps = this.state.steps;
    }


    valuetext = (value) => {
        return `${value}°C`;
    }

    valueLabelFormat = (value) => {
        return this.state.marks.findIndex((mark) => mark.value === value) + 1;
    }

    navigateBack = async (current) => {
        this.setState({loaded: false, inputLabel: {}});

        await this.setState({currentKey: current});

        const initRes = JSON.parse(localStorage.getItem('initialResult'))
        const initDis = JSON.parse(localStorage.getItem('initialDisabledSlider'))
        const steps = this.state.steps;
        const prev = this.getKey( true)
        var res = this.state.result
        var dis = this.state.disabledSlider
        var currentStep = Object.keys(steps)[Object.keys(steps).indexOf(current) - 1]

        res[currentStep] = initRes[currentStep]
        dis[currentStep] = initDis[currentStep]

        if(prev) {
            steps[this.state.currentKey] = false
            steps[prev] = true

            await this.setState({steps: steps, loaded: true, result: res, disabledSlider: dis});
        }
    }

    navigateNext = async (current) => {
        this.setState({loaded: false, inputLabel: {}});

        await this.setState({currentKey: current});

        const steps = this.state.steps;
        const next = this.getKey(false)

        if(next) {
            steps[this.state.currentKey] = false
            steps[next] = true

            await this.setState({steps: steps, loaded: true});

            // console.log('next', this.state.result)
        }
    }

    getKey = (position) => {
        var keys = Object.keys(this.state.steps), key = false;

        if(position) keys = Object.keys(this.state.steps).sort(function(a,b) {return b - a});

        this.setState({
            showNextArr: true,
            showBeforeArr: true,
            showResultBtn: false,
            progressValue: false,
            progressLabel: false,
            progressDesc: false
        });

        Object.values(keys).map((value, k) => {
            if(parseInt(value) === parseInt(this.state.currentKey)) {
                key = parseInt(k) + 1;
            }
        })

        // console.log('key', keys[key], keys[keys.length - 1], position, !position)

        if(!position && keys[key] === keys[keys.length -1] ) this.setState({showNextArr: false, showResultBtn: true});
        if(position && keys[key] === keys[keys.length -1] ) this.setState({showBeforeArr: false});

        return keys[key];
    }


    convertTo = (val, unit) => {
        var lable = Math.round((val / 1000)) + unit;

        if(unit === 'miles') {
            lable = (Math.round((val / 1000)) + ' ' +unit + ' / ' + Math.round(((val / 1000) * 1.609)) + ' km')
        }

       return lable;
    }

    addCar = (currentStep, element) => {
        const items = []
        for(let key = 1; key <= 7; key++){
            Object.values(element).map((el, n) => {
                if(el.quiz_page_attribute === "transport" && el.quiz_type === "radio" && el.parent_id){
                    let hide = key !== 1 ? 'hide' : '';

                    items.push(<div key={`a-${key}-${n}`} id={`transport-${key}-${n}`}
                                    className={el.unit_measure === 'mpg' ? 'transport-cart-left wrap '+ hide : 'transport-cart-right wrap '+ hide}>

                        {n !== 1 && <h2 className={'car-number'} key={`b-${key}-${n}`}>Car {key}</h2>}

                        {el.question && <Title
                            title={`${el.question}`}
                            type={true}
                            transport={true}
                            curentStep={currentStep}
                            key={`c-${key}-${n}`}
                        />}

                        {(el.quiz_type) === 'radio' && <RadioBtn
                            progressData={`${el.label_question}`}
                            unitMeasure={`${el.unit_measure}`}
                            curentStep={currentStep}
                            qty={el.formula_qty}
                            key={`d-${key}-${n}`}
                            step={n}
                            el={key}
                            car={true}
                        />}

                        {(el.custom_field === 1) && <Input
                            unitMeasure={`${el.unit_measure}`}
                            custom={1}
                            car={true}
                            curentStep={currentStep}
                            qty={`${el.formula_qty}`}
                            id={`${key}-${n}`}
                            key={`e-${key}-${n}`}
                            step={n}
                            el={key}
                        />}
                    </div>)
                }
            });
        }

        return items;
    }

    handleStatesUpdate = (states) => {
        this.setState(states);
    };

    useStyles = () => makeStyles((theme) => ({
        margin: {
            margin: theme.spacing(1),
        },
        extendedIcon: {
            marginRight: theme.spacing(1),
        },
    }));

    GreenCheckbox = withStyles({
        root: {
            color: '#16A398',
            '&$checked': {
                color: '#16A398',
            },
        },
        checked: {},
    })((props) => <Chbox color="default" {...props} />);

    PrettySlider = withStyles({
        root: {
            color: '#16A398',
            height: 4,
        },
        thumb: {
            color: '#16A398',
            height: 31,
            width: 31,
            backgroundColor: '#fff',
            border: '4px solid currentColor',
            marginTop: -14,
            marginLeft: -12,
            '&:focus, &:hover, &$active': {
                boxShadow: 'inherit',
            },
        },
        active: {},
        valueLabel: {
            left: 'calc(-50% + 4px)',
        },
        track: {
            height: 4,
            borderRadius: 4,
        },
        rail: {
            height: 4,
            borderRadius: 4,
        },
    })(Slider);

    render(){
        return (
            <Context.Provider
                value={{
                    ...this.state,
                    handleChange: this.handleChange,
                    valuetext: this.valuetext,
                    PrettySlider: this.PrettySlider,
                    handleSliderChange: this.handleSliderChange,
                    valueLabelFormat: this.valueLabelFormat,
                    updateProgressBarData: this.updateProgressBarData,
                    handleRadioChange: this.handleRadioChange,
                    useStyles: this.useStyles,
                    handleSwitch: this.handleSwitch,
                    navigateBack: this.navigateBack,
                    navigateNext: this.navigateNext,
                    getCurrentStep: this.getCurrentStep,
                    setQiuzData: this.setQiuzData,
                    handleStatesUpdate: this.handleStatesUpdate,
                    GreenCheckbox: this.GreenCheckbox,
                    addCar: this.addCar,
                    convertTo: this.convertTo,
                    getResult: this.getResult,
                    resetCalculator: this.resetCalculator
                }}
            >
                {this.props.children}
            </Context.Provider>
        );
    }
}

const Consumer = Context.Consumer;

export { Provider, Consumer };
