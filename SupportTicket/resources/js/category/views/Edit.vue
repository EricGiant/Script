<script setup lang = "ts">
import { useRoute } from 'vue-router';
import CategoryForm from '../components/CategoryForm.vue';
import { getCategoryByID, updateCategory as updateCategoryFunc} from '../store/category';
import { Category } from '../types/category';
import { router } from '../../router';

const category = getCategoryByID(+useRoute().params.categoryID);

const updateCategory = async (category: Category) => {
    await updateCategoryFunc(category);
    router.push({name: "categoryOverview"});
}
</script>

<template>
    <CategoryForm :category = "category" @submit-form = "updateCategory" v-if = "category"/>
</template>