<script setup lang="ts">
import { INote } from "../types/note";
import { computed } from "vue";

const props = defineProps<{
    note: INote;
}>();

const emits = defineEmits(["submitForm"]);

// TODO: gebruik ref met deep copy van props.note ipv computed property
const note = computed(() => ({ ...props.note }));
</script>

<template>
    <form>
        <textarea id="content" v-model="note.content"></textarea>
        <input type="submit" @click.prevent="$emit('submitForm', note)" />
    </form>
</template>

<style scoped>
textarea {
    resize: none;
    width: 500px;
    height: 200px;
    margin-bottom: 5px;
}
</style>
