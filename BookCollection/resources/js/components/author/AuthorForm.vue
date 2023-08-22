<script setup lang = "ts">
import { computed } from "vue";
import { Author } from "../../types/author";

const props = defineProps<{
    author: Author
}>();

const emit = defineEmits(["submitForm"]);

const authorData = computed(() => ({...props.author}));

</script>

<template>
    <form>
        <slot name = "label"></slot>
        <input type ="text" placeholder = "ADD AUTHOR" v-model = "authorData.name" id = "authorName">
        <input type = "submit" value = "SUBMIT" @click.prevent = "$emit('submitForm', authorData)">
        <slot name = "button"></slot>
    </form>
</template>

<style scoped>
form{
    text-align: center;
    margin-top: 10px;
}
form input[type = text]{
    margin: auto;
    margin-top: 5px;
    margin-bottom: 10px;
    display: block;
}
form input[type = submit]{
    margin: 5px 10px 10px 10px;
}
</style>