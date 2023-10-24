<script setup>
import GroceryForm from "../../components/GroceryForm.vue";
import { useRoute } from 'vue-router';
import { getProductById, editProduct } from "../../store/groceries"
import { router } from "../../router/index"

const productId = useRoute().params.productId;
const product = getProductById(productId);

const editProductFunc = (product) => {
    editProduct(product)
    router.push("/");
}
</script>

<template>
    <GroceryForm :product = "product" @editProduct = "editProductFunc"/>
</template>