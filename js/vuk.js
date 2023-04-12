import { getCustomProperty, incrementCustomProperty, setCustomProperty } from "./updateCustomProperty.js"

const JUMP_SPEED = 0.45;
const GRAVITY = 0.0015;
const VUK_FRAME_COUNT = 2; //kretanje 2 slicice
const FRAME_TIME = 100;

const vukElem = document.querySelector("[data-vuk]");

let isJumping;
let vukFrame;
let currentFrameTime;
let yV;

export function setupVuk() {
    isJumping = false;
    vukFrame = 0;
    currentFrameTime = 0;
    yV = 0;
    setCustomProperty(vukElem, "--bottom", 0);
    document.removeEventListener("keydown", onJump);
    // document.removeEventListener("touchstart", onJump);
    document.addEventListener("keydown", onJump);
    document.addEventListener("touchstart", e => {
        console.log("klik");
        onJump(e);
    });
}

export function updateVuk(delta, speadScale) {
    handleRun(delta, speadScale);
    handleJump(delta);
}


export function getVukRect() {
    return vukElem.getBoundingClientRect();
}


function handleRun(delta, speadScale) {
    if (isJumping) {
        vukElem.src = `img/vuk-0.png`;
        return;
    } 

    if (currentFrameTime >= FRAME_TIME) {
        vukFrame = (vukFrame + 1) % VUK_FRAME_COUNT;
        vukElem.src = `img/vuk-${vukFrame}.png`;
        currentFrameTime -= FRAME_TIME;
    }
    currentFrameTime += delta * speadScale;
}


function handleJump(delta) {
    if (!isJumping) return;

    incrementCustomProperty(vukElem, "--bottom", yV * delta);

    if (getCustomProperty(vukElem, "--bottom") <= 0) {
        setCustomProperty(vukElem, "--bottom", 0);
        isJumping = false;
    }

    yV -= GRAVITY * delta;
}


function onJump(e) {
    if (isJumping) return;

    if (e.code == "Space" || e.type == "touchstart") {
        yV = JUMP_SPEED;
        isJumping = true;
    } ;

    console.log(e);
}
