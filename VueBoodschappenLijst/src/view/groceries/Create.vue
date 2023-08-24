<script setup>
import GroceryForm from "../../components/GroceryForm.vue";
import { addProduct, all } from "../../store/Groceries";
</script>

<!-- TODO: product property voor GroceryForm component ontbreekt! -->

<template>
  <GroceryForm @addProduct="addProduct" />
</template>
