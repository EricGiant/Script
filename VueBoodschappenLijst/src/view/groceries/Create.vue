<script setup>
import GroceryForm from "../../components/GroceryForm.vue";
import { addProduct } from "../../store/groceries";
import { router } from "../../router/index"

const addProductFunc = (product) => {
    addProduct(product);
    router.push("/");
}
</script>

<template>
  <GroceryForm :product="{}"  @addProduct="addProductFunc" />
</template>
