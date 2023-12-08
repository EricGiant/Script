import type {IngredientAmount} from '@/ingredient/types/ingredientAmount';
import type {RecipeAmount} from '@/recipe/types/recipeAmount';

export class User {
    id: number;
    name: string;
    email: string;
    ingredients: IngredientAmount[];
    recipes: RecipeAmount[];
    created_at: string;
    updated_at: string;

    constructor(
        id = NaN,
        name = '',
        email = '',
        ingredients: IngredientAmount[] = [],
        recipes: RecipeAmount[] = [],
        created_at = '',
        updated_at = '',
    ) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.ingredients = ingredients;
        this.recipes = recipes;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
