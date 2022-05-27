<style>
    .progress {
        /*line-height: 150px;*/
        background: none;
        margin: 0 auto;
        box-shadow: none;
        position: relative;
    }
    .progress:after {
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 15px solid #bbd5ee;
        position: absolute;
        top: 0;
        left: 0;
    }
    .progress > span {
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
    }
    .progress .progress-left {
        left: 0;
    }
    .progress .progress-bar {
        width: 100%;
        height: 100%;
        background: none;
        border-width: 15px;
        border-style: solid;
        position: absolute;
        top: 0;
        border-color: #0e97ff;
    }
    .progress .progress-left .progress-bar {
        left: 100%;
        border-top-right-radius: 80px;
        border-bottom-right-radius: 80px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
    }
    .progress .progress-right {
        right: 0;
    }
    .progress .progress-right .progress-bar {
        left: -100%;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
    }
    .progress .progress-value {
        border-radius: 50%;
        font-size: 14px;
        text-align: center;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    .progress .progress-value div {
        margin-top: 10px;
    }
    .progress .progress-value span {
        font-size: 12px;
        text-transform: uppercase;
    }

    /* This for loop creates the 	necessary css animation names
    Due to the split circle of progress-left and progress right, we must use the animations on each side.
    */
    .progress[data-percentage="10"] .progress-right .progress-bar {
        animation: loading-1 1.5s linear forwards;
    }
    .progress[data-percentage="10"] .progress-left .progress-bar {
        animation: 0;
    }

    .progress[data-percentage="20"] .progress-right .progress-bar {
        animation: loading-2 1.5s linear forwards;
    }
    .progress[data-percentage="20"] .progress-left .progress-bar {
        animation: 0;
    }

    .progress[data-percentage="30"] .progress-right .progress-bar {
        animation: loading-3 1.5s linear forwards;
    }
    .progress[data-percentage="30"] .progress-left .progress-bar {
        animation: 0;
    }

    .progress[data-percentage="40"] .progress-right .progress-bar {
        animation: loading-4 1.5s linear forwards;
    }
    .progress[data-percentage="40"] .progress-left .progress-bar {
        animation: 0;
    }

    .progress[data-percentage="50"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="50"] .progress-left .progress-bar {
        animation: 0;
    }

    .progress[data-percentage="60"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="60"] .progress-left .progress-bar {
        animation: loading-1 1.5s linear forwards 1.5s;
    }

    .progress[data-percentage="70"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="70"] .progress-left .progress-bar {
        animation: loading-2 1.5s linear forwards 1.5s;
    }

    .progress[data-percentage="80"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="80"] .progress-left .progress-bar {
        animation: loading-3 1.5s linear forwards 1.5s;
    }

    .progress[data-percentage="90"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="90"] .progress-left .progress-bar {
        animation: loading-4 1.5s linear forwards 1.5s;
    }

    .progress[data-percentage="100"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .progress[data-percentage="100"] .progress-left .progress-bar {
        animation: loading-5 1.5s linear forwards 1.5s;
    }

    @keyframes loading-1 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(36);
            transform: rotate(36deg);
        }
    }
    @keyframes loading-2 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(72);
            transform: rotate(72deg);
        }
    }
    @keyframes loading-3 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(108);
            transform: rotate(108deg);
        }
    }
    @keyframes loading-4 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(144);
            transform: rotate(144deg);
        }
    }
    @keyframes loading-5 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(180);
            transform: rotate(180deg);
        }
    }

</style>

<div {{$attributes->merge(['class' =>'progress'])}}>
    <span class="progress-left">
        <span class="progress-bar"></span>
    </span>
    <span class="progress-right">
        <span class="progress-bar"></span>
    </span>
    <div class="progress-value mt-4">
        {{ $slot }}
    </div>
</div>
