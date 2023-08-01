<script setup>
import { defineProps } from "vue";

const props = defineProps({
    inventory: Array
});

</script>

<template>
    <table>
        <tr>
            <th>NAME</th>
            <th>CURRENT AMOUNT</th>
            <th>REQUIRED AMOUNT</th>
        </tr>
        <tr v-for = "product in props.inventory">
            <td>{{ product.name }}</td>
            <td>{{ product.actualAmount }}</td>
            <td>{{ product.miniumAmount }}</td>
            <router-link :to = "{ name: 'edit', params: { productId: product.id}}">EDIT</router-link>
        </tr>
    </table>
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