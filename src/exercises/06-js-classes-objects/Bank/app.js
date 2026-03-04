import BankAccount from "./classes/BankAccount.js";
import SavingsAccount from "./classes/SavingsAccount.js";
import CurrentAccount from "./classes/CurrentAccount.js";

let bank = new BankAccount("1111111111", "Alice", 100.00);
let savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);
let current = new CurrentAccount("3333333333", "Charlie", 100.00);

console.log(bank.toString());
console.log(savings.toString());

current.withdraw(50);
current.deposit(100);
console.log(current.toString());