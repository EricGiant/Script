export class RecipeAmount {
    recipeId: number;
    amount: number;

    constructor(recipeId = NaN, amount = NaN) {
        this.recipeId = recipeId;
        this.amount = amount;
    }
}
