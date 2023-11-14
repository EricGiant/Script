import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';

export class Recipe {
    id: number;
    name: string;
    content: string;
    ingredients: IngredientAmount[];
    created_at: string;
    updated_at: string;

    constructor(id = NaN, name = '', content = '', ingredients = [], created_at = '', updated_at = '') {
        this.id = id;
        this.name = name;
        this.content = content;
        this.ingredients = ingredients;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
