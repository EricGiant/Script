<script setup lang = "ts">
import { computed } from 'vue';
import { Review } from '../../types/review'
const props = defineProps<{
    review: Review
}>();

const emit = defineEmits(["submitForm"]);

const reviewData = computed(() => ({ ...props.review }));
</script>

<template>
    <form>
        <textarea v-model = "reviewData.content"></textarea>
        <input type = "submit" @click.prevent =" $emit('submitForm', reviewData)">
        <slot></slot>
    </form>
</template>

<style scoped>
form{
    width: 60%;
    margin: auto;
    margin-top: 15px;
    text-align: center;
}
form textarea{
    resize: none;
    height: 100px;
    width: 100%;
}
form input{
    margin: 5px 10px 10px 10px;
}
</style>