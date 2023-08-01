<script setup>
import InventoryTable from '../../components/InventoryTable.vue';
import { inventory } from "../../store/Inventory";

</script>

<template>
    <InventoryTable :inventory = "inventory"/>
    <router-link :to = "{name: 'create'}" style = "text-align: center; display: block;">ADD PRODUCT</router-link>
    <router-link :to = "{name: 'order'}" style = "text-align: center; display: block;">ORDER PRODUCTS</router-link>
</template>