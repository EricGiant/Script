<script setup lang = "ts">
import { ref } from 'vue';
import { forgotPassword } from '../store/authentication';

const email = ref();
</script>

<template>
    <form>
        <label for = "email">EMAIL</label>
        <input type = "email" v-model = "email" id = "email">
        <input type = "submit" @click.prevent = "forgotPassword(email)">
    </form>
</template>