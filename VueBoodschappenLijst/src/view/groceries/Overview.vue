<script setup>
import { products, deleteProduct } from "../../store/groceries";
import GroceriesTable from "../../components/GroceriesTable.vue";
</script>

<template>
    <GroceriesTable :products="products" @deleteProduct = "deleteProduct"/>
    <router-link :to = "{ name: 'create'}" style = "text-align: center; display: block;">ADD PRODUCT</router-link>
</template>