<script setup lang = "ts">
import Navbar from '../../navbar/components/navbar.vue';
import { getCategories, deleteCategory } from '../store/category';
import { computed } from 'vue';

//for some reason directly editing the getCategories without a function/computed will cause it to lose reactivity. to fix this just make it a computed.
const allCategoriesFiltered = computed(() => getCategories().value?.sort((a, b) => a.title.localeCompare(b.title)));

const deleteCategoryCheck = async (id: number) => {
    if(confirm("ARE U SURE U WANT TO DELETE THIS CATEGORY?"))
    {
        await deleteCategory(id);
    }
}
</script>

<template>
    <Navbar />
    <table>
        <th>TITLE</th>
        <tr v-for = "category in allCategoriesFiltered">
            <td>{{category.title}}</td>
            <td><router-link :to = "{name: 'categoryEdit', params: {categoryID: category.id}}">EDIT CATEGORY</router-link></td>
            <td><button @click.prevent = "deleteCategoryCheck(category.id)">DELETE CATEGORY</button></td>
        </tr>
    </table>
</template>

<style>
table{
    margin: auto;
}
td{
    text-align: center;
}
</style>