<script setup>
// TODO: ongebruikde imports / code verwijderen
import { RouterLink } from "vue-router";
import GroceriesTable from "../../components/GroceriesTable.vue";

// TODO: zet boodschappen in afzonderlijk data bestand en importeer deze
// TODO: realistische test-data gebruiken, dus echte boodschappennamen
// TODO: bonus opdracht: maak een class definitie voor een boodschap en voeg een subTotal getter toe die dynamische
// het subtotaal berekent
const productList = [
  {
    name: "test",
    price: 5,
    amount: 5,
  },
  {
    name: "test2",
    price: 4,
    amount: 10,
  },
  {
    name: "test3",
    price: 50,
    amount: 1,
  },
];
</script>

<template>
  <GroceriesTable v-bind:productList="productList" />
</template>
