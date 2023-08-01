<script setup>
import { getProductById } from '../../store/Inventory';
import InventoryForm from '../../components/InventoryForm.vue';
import { editProduct } from '../../store/Inventory';
import { useRoute } from "vue-router";

const productId = useRoute().params.productId;
const product = getProductById(productId);

</script>

<template>
    <InventoryForm :product = "product" @editProduct = "editProduct"/>
</template>