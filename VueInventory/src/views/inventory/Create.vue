<script setup>
import InventoryForm from '../../components/InventoryForm.vue';
import { addProduct } from '../../store/Inventory';
</script>

<template>
    <InventoryForm @addProduct = "addProduct"/>
</template>