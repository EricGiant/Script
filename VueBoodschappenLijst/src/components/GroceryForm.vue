<script setup>
    import { defineProps, defineEmits } from 'vue'

    const props = defineProps({
        product: Object
    });

    const emit = defineEmits(["addProduct", "editProduct"])

    const productData = {...props.product}
</script>

<template>
    <form>
        <label for = "name">NAME</label>
        <input type = "text" v-model = "productData.name">
        <label for = "price">PRICE</label>
        <input type = "number" v-model = "productData.price">
        <label for = "amount">AMOUNT</label>
        <input type = "number" v-model = "productData.amount"><br>
        <button type = "button" @click = "$emit('addProduct', productData)" v-if = "productData.id == undefined">ADD PRODUCT</button>
        <button type = "button" @click = "$emit('editProduct', productData)" v-else-if = "productData.id != undefined">EDIT PRODUCT</button>
    </form>
</template>

<style scoped>
table
{
    margin: auto;
    text-align: center;
}
form
{
    text-align: center;
}
label
{
    padding-top: 5px;
}
label, input
{
    display: block;
    margin: auto;
    width: 100px;
}
</style>