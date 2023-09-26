<script setup lang = "ts">
import { ref } from 'vue';
import { forgotPassword } from '../store/authentication';
import { router } from '../../router';

const email = ref();

const forgotPasswordFunc = async () => {
    await forgotPassword(email.value);
    alert("AN EMAIL HAS BEEN SEND TO YOUR ACCOUNT");
    router.push({name: "login"});
}
</script>

<template>
    <form>
        <label for = "email">EMAIL</label>
        <input type = "email" v-model = "email" id = "email">
        <input type = "submit" @click.prevent = "forgotPasswordFunc()">
    </form>
</template>