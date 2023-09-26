<script setup lang = "ts">
import { ref } from 'vue';
import { router } from '../../router';
import LoginForm from '../components/LoginForm.vue';
import { authenticateUser } from '../store/authentication';
import { Login } from '../types/login';
import { setUser } from '../../user/store/user';
import { getError } from '../../error/store/error';

const password_error = ref("");
const email_error = ref("");

const submitForm = async (data: Login) => {
    const response = await authenticateUser(data);
    password_error.value = "";
    email_error.value = "";
    if(response == undefined)
    {
        const error = getError().value;
        if(error?.code == 422)
        {
            email_error.value = error.message;
        }
        else if(error?.code == 401)
        {
            password_error.value = error.message;
        }
    }
    else if(typeof response == "object")
    {
        setUser(response);
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