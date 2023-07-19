<script setup>
import GroceryForm from '../../components/GroceryForm.vue';
import { addProduct } from '../../store/Groceries';
</script>

<template>
    <GroceryForm @addProduct = "addProduct"/>
</template>