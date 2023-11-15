export class IngredientTable {
    ingredientId: number;
    amount: number;
    editable: boolean;

    constructor(ingredientId = NaN, amount = NaN, editable = false) {
        this.ingredientId = ingredientId;
        this.amount = amount;
        this.editable = editable;
    }
}
