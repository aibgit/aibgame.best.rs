import { incrementCustomProperty, setCustomProperty } from "./updateCustomProperty.js"

const SPEED = 0.055;
const STONE_INTERVAL_MIN = 1000;
const STONE_INTERVAL_MAX = 2500;

const worldElem = document.querySelector("[data-world]");

let nextStoneTime;

export function setupStone() {
    nextStoneTime = STONE_INTERVAL_MIN;
    document.querySelectorAll("[data-stone]").forEach(stone => {
        stone.remove();
    });
}

export function updateStone(delta, speadScale) {
    document.querySelectorAll("[data-stone]").forEach(stone => {
        incrementCustomProperty(stone, "--left", delta * speadScale * SPEED * -1);
        if (getComputedStyle(stone, "--left") <= -100) {
            stone.remove();
        }
    });

    if (nextStoneTime <= 0) {
        createStone();
        nextStoneTime = randomNumberBetween(STONE_INTERVAL_MIN, STONE_INTERVAL_MAX) / speadScale;
    }
    nextStoneTime -= delta;
}


export function getStoneRects() {
    return [...document.querySelectorAll("[data-stone]")].map(stone => {
        return stone.getBoundingClientRect();
    });
}

function generateRandomStone(){
    let pickACard = Math.floor(Math.random()*3);
    let imageURL;
    switch(pickACard){
        case 0:
            imageURL = `img/planina-1.png`;
            break;
        case 1:
            imageURL = `img/planina-2.png`;
            break;
        case 2:
            imageURL = `img/planina-3.png`;
            break;
    }

    return imageURL;
}

function createStone() {
    const stone = document.createElement("img");
    stone.dataset.stone = true;
    // stone.src = `img/planina-3.png`;
    stone.src = generateRandomStone();
    stone.classList.add("stone");
    setCustomProperty(stone, "--left", 100);
    worldElem.append(stone);
}


function randomNumberBetween(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
