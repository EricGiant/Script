<script setup lang="ts">
import type {Ingredient} from '../types/ingredient';
import type {Category} from '@/category/types/category';

import CategorySelecterBox from '@/category/components/CategorySelecterBox.vue';
import Navbar from '@/navbar/components/Navbar.vue';

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
    <Navbar />

    <form>
        <label id="categoryLabel">CATEGORY</label>

        <CategorySelecterBox @press-category="categorySelect" />

        <label for="name">NAME</label>

        <br />

        <input id="name" v-model="ingredient.name" type="text" />

        <br />

        <input type="submit" @click.prevent="emit('submitForm', ingredient)" />
    </form>
</template>

<style scoped>
form {
    margin-top: 5px;
    text-align: center;
}
#box {
    margin-bottom: 5px;
}
label {
    display: inline-block;
    margin-bottom: 5px;
}
input[type='text'] {
    margin-bottom: 10px;
}
</style>
