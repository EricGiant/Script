<script setup lang="ts">
import type {Ingredient} from '../types/ingredient';
import type {Category} from '@/category/types/category';

import CategorySelecterBox from '@/category/components/CategorySelecterBox.vue';

const props = defineProps<{
    ingredient: Ingredient;
}>();

const emit = defineEmits<{
    (event: 'submitForm', ingredient: Ingredient): void;
}>();

const ingredient = {...props.ingredient};

const categorySelect = (category: Category) => {
    ingredient.categoryId = category.id;
};
</script>

<template>
    <form>
        <div class="m-auto" style="width: fit-content">
            <div class="text-center">
                <label class="h3 mb-2">CATEGORY</label>
            </div>

            <CategorySelecterBox @press-category="categorySelect" />
        </div>

        <div class="col-sm-2 m-auto mt-3 text-center">
            <label for="name" class="h3">NAME</label>

            <input id="name" v-model="ingredient.name" type="text" class="form-control" />
        </div>

        <div class="mt-3 text-center">
            <button type="submit" class="btn btn-primary fs-4" @click.prevent="emit('submitForm', ingredient)">
                ADD
            </button>
        </div>
    </form>
</template>
