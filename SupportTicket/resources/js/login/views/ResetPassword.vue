<script setup lang = "ts">
import { ref } from 'vue';
import { updatePassword } from '../store/authentication';
import { useRoute } from 'vue-router';

const password = ref();
const token = useRoute().params.token as string;
</script>

<template>
    <form>
        <label for = "password">PASSWORD</label>
        <input type = "password" id = "password" v-model = "password">
        <input type = "submit" @click.prevent = "updatePassword(password, token)">
    </form>
</template>