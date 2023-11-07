<script setup lang="ts">
import { Login } from "../types/login";

defineEmits(["submitForm"]);

const login = new Login();
</script>

<template>
    <form>
        <label for="name">NAME</label><br />
        <input type="text" id="name" v-model="login.name" /><br />
        <label>PASSWORD</label><br />
        <input type="password" id="password" v-model="login.password" /><br />
        <input type="submit" @click.prevent="$emit('submitForm', login)" />
    </form>
</template>

<style>
form {
    text-align: center;
    font-size: 0;
}
label {
    font-size: 16px;
}
input[type="text"] {
    margin-bottom: 6px;
}
input[type="password"] {
    margin-bottom: 10px;
}
</style>
