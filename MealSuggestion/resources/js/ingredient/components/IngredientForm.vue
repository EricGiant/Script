<script setup lang="ts">
import { Ingredient } from "../types/ingredient";
import CategorySelecterBox from "../../category/components/CategorySelecterBox.vue";
import { Category } from "../../category/types/category";
import Navbar from "../../navbar/components/Navbar.vue";

const props = defineProps<{
    ingredient: Ingredient;
}>();

defineEmits(["submitForm"]);

const ingredient = { ...props.ingredient };

const categorySelect = (category: Category) => {
    ingredient.category_id = category.id;
};
</script>

<template>
    <Navbar />
    <form>
        <label id="categoryLabel">CATEGORY</label>
        <CategorySelecterBox @press-category="categorySelect" />
        <label for="name">NAME</label><br />
        <input type="text" id="name" v-model="ingredient.name" /><br />
        <input type="submit" @click.prevent="$emit('submitForm', ingredient)" />
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
input[type="text"] {
    margin-bottom: 10px;
}
</style>
