export class Ingredient {
    id: number;
    name: string;
    categoryId: number;
    created_at: string;
    updated_at: string;

    constructor(id = NaN, name = '', categoryId = NaN, created_at = '', updated_at = '') {
        this.id = id;
        this.name = name;
        this.categoryId = categoryId;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
