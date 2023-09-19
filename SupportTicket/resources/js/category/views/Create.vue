<script setup lang = "ts">
import CategoryForm from '../components/CategoryForm.vue';
import { Category } from '../types/category';
import { storeCategory } from '../store/category';
import { router } from '../../router';

const category = {
    id: NaN,
    title: "",
    created_at: "",
    updated_at: ""
}

const addCategory = async (category: Category) => {
    await storeCategory(category);
    router.push({name: "categoryOverview"});
}
</script>

<template>
    <CategoryForm :category = "category" @submit-form = "addCategory"/>
</template>