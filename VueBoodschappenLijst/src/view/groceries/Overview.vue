<script setup>
import { RouterLink } from "vue-router";
import GroceriesTable from "../../components/GroceriesTable.vue";

const productList = [
    {
        name: "test",
        price: 5,
        amount: 5
    },
    {
        name: "test2",
        price: 4,
        amount: 10
    },
    {
        name: "test3",
        price: 50,
        amount: 1
    }]

</script>

<template>
    <GroceriesTable v-bind:productList = "productList"/>
</template>