import BankAccount from "./BankAccount.js";

class CurrentAccount extends BankAccount {

    constructor(_num, _name, _bal) {
        super(_num, _name, _bal);
        this.transactionCount = 0;
    }

    toString() {
        return `Current Account: ${this.number}, Name: ${this.name}, Balance: €${this.balance}, Transaction Count: ${this.transactionCount}`;
    }

    deposit(amount) {
        this.transactionCount++;
        this.balance += amount;
    }

    withdraw(amount) {
        this.transactionCount++;
        this.balance -= amount;
    }

    getTransactionCount() {
        return this.transactionCount;
    }
}

export default CurrentAccount;