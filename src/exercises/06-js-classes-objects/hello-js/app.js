import Car from "./classes/Car.js";

let bmw = new Car("BMW", "5 Serires", 2025, "Green", ["something", "something"]);
console.log(`${bmw}`);

let otherCar = new Car("BMX", "6 Series", 2026, "Red", ["something else", "something else"]);

let myCarCollection = [bmw, otherCar];

myCarCollection.forEach((car)=>{
    console.log(`${car.model} ${car.getExtras()}, `);
});
