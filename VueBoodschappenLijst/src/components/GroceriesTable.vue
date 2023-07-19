<script setup>
import { defineProps, defineEmits } from 'vue';
import { totalPrice } from '../store/Groceries';

const props = defineProps({
    products: Array
})

const emits = defineEmits(["deleteProduct"]);

</script>

<template>
    <table>
        <tr>
            <th>NAME</th>
            <th>PRICE</th>
            <th>AMOUNT</th>
            <th>TOTAL</th>
        </tr>
        <tr v-for = "product in products">
            <td>{{product.name}}</td>
            <td>{{product.price}}</td>
            <td>{{product.amount}}</td>
            <td>{{product.price * product.amount}}</td>
            <router-link :to = "{ name: 'edit', params: { productId: product.id}}">EDIT</router-link>
            <button type = "button" @click = "$emit('deleteProduct', product)">DELETE</button>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td></td>
            <td></td>
            <td v-if = "totalPrice != 0">{{totalPrice}}</td>
        </tr>
    </table>
</template>

<style scoped>
    table
    {
        margin: auto;
        text-align: center;
    }
</style>