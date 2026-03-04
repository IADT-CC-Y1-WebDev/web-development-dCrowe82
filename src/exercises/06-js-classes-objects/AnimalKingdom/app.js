import Cat from "./classes/Cat.js";
import Dog from "./classes/Dog.js";
import Wolf from "./classes/Wolf.js";
import Lion from "./classes/Lion.js";

let cat1 = new Cat("Tom", 2);
let dog1 = new Dog("Jerry", 4);
let wolf1 = new Wolf("Walt", 5);
let lion1 = new Lion("Alex", 4);

let animals = [cat1, dog1, lion1, wolf1];

animals.forEach((animal)=>{
    animal.makeNoise();
    animal.roam();
    animal.sleep();

    console.log("--------");
})