<script setup lang = "ts">
import { Category } from '../types/category';

const props = defineProps<{
    category: Category
}>();

const emits = defineEmits(["submitForm"]);

const category = {...props.category};
</script>

<template>
    <form>
        <label for = "title">TITLE</label>
        <input type = "text" id = "title" v-model = "category.title">
        <input type = "submit" @click.prevent = "$emit('submitForm', category)">
    </form>
</template>