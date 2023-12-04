<script setup lang="ts">
import {ref} from 'vue';

const emit = defineEmits<{
    (event: 'submitForm', email: string): void;
}>();

const email = ref('');
</script>

<template>
    <form class="col-sm-2 m-auto text-center">
        <label for="email" class="h3">EMAIL</label>

        <input id="email" v-model="email" type="email" class="form-control" />

        <input type="submit" class="btn btn-primary fs-4 mt-3" @click.prevent="emit('submitForm', email)" />
    </form>
</template>
