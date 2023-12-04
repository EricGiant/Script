<script setup lang="ts">
import {ref} from 'vue';

const emit = defineEmits<{
    (event: 'submitForm', password: string): void;
}>();

const password = ref('');
</script>

<template>
    <form class="col-sm-2 m-auto text-center">
        <label for="password" class="h3">PASSWORD</label>

        <input id="password" v-model="password" class="form-control" type="password" />

        <input type="submit" class="btn btn-primary fs-4 mt-3" @click.prevent="emit('submitForm', password)" />
    </form>
</template>
