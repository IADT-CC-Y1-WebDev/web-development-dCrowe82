class Animal {
    constructor(_name, _age){
        this.name = _name;
        this.age = _age;
    }

    sleep () {
        console.log("Sleeping: Zzzzzzz");
    }

    makeNoise() {
        console.log("Noises");
    }

    roam() {
        console.log("Roaming: roam roam");
    }
}

export default Animal;