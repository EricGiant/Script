<script setup lang = "ts">
import { ref } from 'vue';
import { router } from '../../router';
import LoginForm from '../components/LoginForm.vue';
import { authenticateUser } from '../store/authentication';
import { Login } from '../types/login';
import { setUser } from '../../user/store/user';


const password_error = ref("");
const email_error = ref("");

//REWORK THIS BECAUSE THIS IS NOT MAINTABLEBLE.
//use axios handlign that WILL NOT WORK FOR SOME REASON.
//jeroen said hed check it but he hasn't yet
const submitForm = async (data: Login) => {
    const response = await authenticateUser(data);
    password_error.value = "";
    email_error.value = "";
    if(response.data == "LOGIN FAILED")
    {
        password_error.value = "INVALID PASSWORD";
    }
    else if(response == 422)
    {
        email_error.value = "INVALID EMAIL";
    }
    else if(typeof response.data == "object")
    {
        setUser(response.data);
        router.push({name: "ticketOverview"});
    }
}
</script>

<template>
    <LoginForm @submit-form = "submitForm">
        <template #password_error v-if = "password_error"><label for = "password" class = "error">{{ password_error }}</label></template>
        <template #email_error v-if = "email_error"><label for = "email" class = "error">{{ email_error }}</label></template>
    </loginForm>
    <router-link :to = "{name: 'forgotPassword'}">FORGOT PASSWORD</router-link>
</template>

<style scoped>
a{
    text-align: center;
    margin: auto;
    display: block;
}
</style>