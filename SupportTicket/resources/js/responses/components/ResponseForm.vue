<script setup lang = "ts">
import { computed } from 'vue';
import { Response } from '../types/response';

const props = defineProps<{
    response: Response
}>()

const emits = defineEmits(["submitForm"]);

const response = computed(() => ({...props.response}));
</script>

<template>
    <form>
        <textarea id = "content" v-model = "response.content"></textarea>
        <input type = "submit" @click.prevent = "$emit('submitForm', response)">
    </form>
</template>

<style scoped>
textarea{
    resize: none;
    width: 500px;
    height: 200px;
    margin-bottom: 5px;
}
</style>