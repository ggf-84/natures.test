<style>
    .loader {
        {{--background: #fbfdfc url({{asset('img/loaderCo2.gif')}});--}}
        {{--background-position: center;--}}
        {{--background-repeat: no-repeat;--}}
        {{--background-size: 85px;--}}
        {{--width: 100%;--}}
        {{--height: 100%;--}}
        /*transition: opacity .3s ease-out;*/
    }
    .hidden{
        /*display:none;*/
        /*transition: opacity .3s ease-out;*/
    }
    body, #main, #calculator {
        min-height: 100%;
        margin: 0;
    }
    body{
        margin: 0;
    }
</style>

<div id="main">
    <div id="calculator"></div>
</div>

<script src="js/app.js"></script>
