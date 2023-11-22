<script setup lang="ts">
import type {Category} from '../types/category';

import {getCategories} from '../store/category';

const emit = defineEmits<{
    (event: 'pressCategory', category: Category): void;
}>();

const categories = getCategories();
</script>

<template>
    <div id="box">
        <div v-for="category in categories" :key="category.id">
            <label :for="category.name">{{ category.name }}</label>

            <input :id="category.name" type="radio" name="category" @click="emit('pressCategory', category)" />
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
