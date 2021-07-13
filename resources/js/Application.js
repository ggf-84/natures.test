import React from 'react';
import ReactDOM from 'react-dom';
import Quiz from './components/Quiz'
import ResultPage from './components/ResultPage'
import { Provider, Consumer} from './context'

export default function Application() {
    return <Consumer>
        {value => {
            const { loaded, data, showResultPage } = value;
            if(loaded) return(<>
                {!showResultPage && <Quiz data={data}/>}
                {showResultPage && <ResultPage />}
            </>)
        }}
    </Consumer>
}

if (document.getElementById('calculator')) {
        ReactDOM.render(
        <Provider>
            <Application/>
        </Provider>,
        document.getElementById('calculator')
    );
}
