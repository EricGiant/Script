export class Ingredient {
    id: number;
    name: string;
    category_id: number;
    created_at: string;
    updated_at;

    constructor(
        id = NaN,
        name = "",
        category_id = NaN,
        created_at = "",
        updated_at = ""
    ) {
        this.id = id;
        this.name = name;
        this.category_id = category_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
