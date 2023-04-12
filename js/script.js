import { setupGround, updateGround } from './ground.js'
import { setupVuk, updateVuk, getVukRect } from './vuk.js'
import { setupStone, updateStone, getStoneRects } from './stone.js'

const WORLD_WIDTH = 100;
const WORLD_HEIGHT = 40;
const SPEED_SCALE_INCREASE = 0.00001;

const worldElem = document.querySelector("[data-world]");
const scoreElem = document.querySelector("[data-score]");
const startElem = document.querySelector("[data-start]");
const restartElem = document.querySelector("[data-restart]");
const rezultatElem = document.querySelector("[data-rezultat]");
const startBtn = document.querySelector("[data-start-btn]");
const restartBtn = document.querySelector("[data-restart-btn]");
// const logoutBtn = document.querySelector("[data-logout-btn]");

console.log("ide igraaa");
resizeWorld();
window.addEventListener("resize", resizeWorld);
// window.addEventListener("click", handleStart, { once: true });
startBtn.addEventListener("click", handleStart, { once: true });

let hiddenDoc = false;
document.addEventListener("visibilitychange", function(event) {
    hiddenDoc = true;
});


let lastTime;
let speedScale;
let score;

// update
function update(time) {

    if (lastTime == null) {
        lastTime = time;
        window.requestAnimationFrame(update);
        return;
    }
    const delta = time - lastTime;
    // console.log(delta);

    updateGround(delta, speedScale);
    updateVuk(delta, speedScale);
    updateStone(delta, speedScale);
    updateSpeedScale(delta);
    updateScore(delta);
    
    // console.log(checkLose());
    if (checkLose() || hiddenDoc){
        console.log("KRAJ IGRE");
        return handleLose();
    } 

    lastTime = time;
    window.requestAnimationFrame(update);
}

function updateSpeedScale(delta) {
    speedScale += delta * SPEED_SCALE_INCREASE;
}

function updateScore(delta) {
    score += delta * 0.01;
    scoreElem.textContent = Math.floor(score);
    // console.log(score);
}

function checkLose() {

    const vukRect = getVukRect();
    return getStoneRects().some(rect => isCollision(rect, vukRect));
}


function isCollision(reactStena, reactVuk) {  
    //react1 - stena  //react2 - vuk

    var padding = (reactVuk.right - reactVuk.left) * 0.1;

    // if(reactStena.top < reactVuk.bottom) {
    //     console.log("prvi uslov");
    //     return (
    //         reactStena.right > reactVuk.left &&
    //         reactStena.bottom > reactVuk.top &&
    //         reactStena.left + padding < reactVuk.right && 
    //         reactStena.top + padding*4 < reactVuk.bottom
    //     );
    // }

    if((reactVuk.left > reactStena.left) && (reactVuk.left < reactStena.right)) {
        console.log("drugi uslov");
        return (
            reactStena.right > reactVuk.left + padding*3 &&
            reactStena.bottom > reactVuk.top &&
            reactStena.left + padding < reactVuk.right  &&
            reactStena.top + padding < reactVuk.bottom
        );
    } 

    if((reactVuk.right > reactStena.left) && (reactVuk.right < reactStena.right)) {
        console.log("treci uslov");
        return (
            reactStena.right > reactVuk.left + padding &&
            reactStena.bottom > reactVuk.top &&
            reactStena.left + padding < reactVuk.right  &&
            reactStena.top + padding*3 < reactVuk.bottom
        );
    } 

    console.log("bez uslova");
    return (
        reactStena.right - padding > reactVuk.left && 
        reactStena.bottom > reactVuk.top &&
        reactStena.left + padding < reactVuk.right && 
        reactStena.top + padding < reactVuk.bottom
    );
        
    
}

// start
function handleStart() {
    hiddenDoc = false;
    lastTime = null;
    speedScale = 1;
    score = 0;
    setupGround();
    setupVuk();
    setupStone();
    scoreElem.classList.remove("hide");
    startElem.classList.add("hide");
    restartElem.classList.add("hide");
    window.requestAnimationFrame(update);
}

// lose
function handleLose() {
   
    setTimeout(() => {
       
        restartElem.classList.remove("hide");

        rezultatElem.textContent = Math.floor(score);
        writeScore(Math.floor(score));

        restartBtn.addEventListener("click", handleStart, { once: true });
        
    }, 100);
}

function writeScore(skor) {
    let request = $.post("./model/score.php", {skor: skor});
    console.log(request);
    request.done(function(response) {
        console.log(response);
    });
}


// resizing 
function resizeWorld() {
    let worldScale;
    if (window.innerWidth / window.innerHeight < WORLD_WIDTH / WORLD_HEIGHT)
    {
        worldScale = window.innerWidth / WORLD_WIDTH;
    } else {
        worldScale = window.innerHeight / WORLD_HEIGHT;
    }

    worldElem.style.width = `${WORLD_WIDTH * worldScale}px`;
    worldElem.style.height = `${WORLD_HEIGHT * worldScale}px`
}   

