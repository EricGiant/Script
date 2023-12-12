<script setup lang="ts">
import { ref } from 'vue';

const emit = defineEmits(["submitForm"]);

const data = ref<{
    email: "",
    password: ""}>({email: "", password: ""});
</script>

<template>
    <form>
        <label for="email">EMAIL</label>
        <input type="text" id="email" v-model="data.email" />
        <slot name="email_error"></slot>
        <label for="password">PASSWORD</label>
        <input type="password" id="password" v-model="data.password" />
        <slot name="password_error"></slot>
        <input type="submit" @click.prevent="$emit('submitForm', data)" />
    </form>
</template>

<style>
form {
    text-align: center;
    margin: auto;
}
label {
    display: block;
    margin-bottom: 5px;
}
input {
    margin-bottom: 5px;
}
input[type="submit"] {
    display: block;
    margin: auto;
}
.error {
    color: red;
    font-weight: bolder;
    font-size: 20px;
}
</style>
