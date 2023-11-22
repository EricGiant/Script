export class IngredientAmount {
    ingredientId: number;
    amount: number;

    constructor(ingredientId = NaN, amount = NaN) {
        this.ingredientId = ingredientId;
        this.amount = amount;
    }
}
