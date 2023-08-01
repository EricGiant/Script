<script setup>
import { router } from '../../router';
import { getProductsToOrder } from '../../store/Inventory';

const products = getProductsToOrder();

</script>

<template>
    <table>
        <tr>
            <th>PRODUCTS TO ORDER</th>
        </tr>
        <tr v-for = "product in products">
            <td>{{ product.name }}</td>
        </tr>
    </table>
    <router-link :to = "{ name: 'home'}" style = "text-align: center; display: block;">BACK</router-link>
</template>

<style scoped>
table
{
    margin: auto;
    text-align: center;
}
td
{
    font-size: 18px;
}
</style>