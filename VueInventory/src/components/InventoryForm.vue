<script setup>
import { defineProps, defineEmits } from 'vue';
import { router } from "../router/index";

const props = defineProps({
    product: Object
});

const emit = defineEmits(["addProduct", "editProduct"]);

const productData = {...props.product};

</script>

<template>
    <form>
        <label for = "name">NAME</label>
        <input type = "text" v-model = "productData.name">
        <label for = "miniumAmount">MINIUM AMOUNT</label>
        <input type = "number" v-model = "productData.miniumAmount">
        <label for = "actualAmount">ACTUAL AMOUNT</label>
        <input type = "number" v-model = "productData.actualAmount">
        <button type = "button" @click = "$emit('addProduct', productData)" v-if = "productData.id == undefined">ADD PRODUCT</button>
        <button type = "button" @click = "$emit('editProduct', productData)" v-else-if = "productData.id != undefined">EDIT PRODUCT</button>
        <button type = "button" @click = "router.push('/')">CANCEL</button>
    </form>
</template>

<style scoped>form
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