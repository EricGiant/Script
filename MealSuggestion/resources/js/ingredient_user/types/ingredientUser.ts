export class IngredientUser {
    ingredient_id: number;
    amount: number;

    constructor(ingredient_id = NaN, amount = NaN) {
        this.ingredient_id = ingredient_id;
        this.amount = amount;
    }
}
