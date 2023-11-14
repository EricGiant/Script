export class Login {
    name: string;
    password: string;

    constructor(name = '', password = '') {
        this.name = name;
        this.password = password;
    }
}
