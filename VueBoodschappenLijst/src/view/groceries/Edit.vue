<script setup>
import GroceryForm from "../../components/GroceryForm.vue";
import { useRoute } from 'vue-router';
import { getProductById, editProduct } from "../../store/Groceries"

const productId = useRoute().params.productId;
const product = getProductById(productId);
</script>

<template>
    <GroceryForm :product = "product" @editProduct = "editProduct"/>
</template>