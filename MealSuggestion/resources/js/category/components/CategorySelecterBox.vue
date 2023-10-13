<script setup lang="ts">
import { getCategories } from "../store/category";

defineEmits(["pressCategory"]);

const categories = getCategories();
</script>

<template>
    <div id="box">
        <div v-for="category in categories">
            <label :for="category.name">{{ category.name }}</label>
            <input
                type="radio"
                name="category"
                :id="category.name"
                @click="$emit('pressCategory', category)"
            />
        </div>
    </div>
</template>

<style scoped>
#box {
    height: fit-content;
    max-height: 100px;
    width: fit-content;
    margin: auto;
    overflow-y: scroll;
    border: 2px solid black;
    text-align: left;
}
label {
    padding-left: 5px;
}
</style>
