<script setup lang = "ts">
import { ref } from 'vue';
import { router } from '../../router';
import LoginForm from '../components/LoginForm.vue';
import { authenticateUser } from '../store/authentication';
import { Login } from '../types/login';
import { setUser } from '../../user/store/user';


const password_error = ref("");
const email_error = ref("");

const submitForm = async (data: Login) => {
    const reponse = await authenticateUser(data);
    password_error.value = "";
    email_error.value = "";
    if(reponse.data)
    {
        setUser(reponse.data);
        router.push({name: "ticketOverview"});
    }
    else if(reponse.data == false)
    {
        password_error.value = "INVALID PASSWORD";
    }
    else if(reponse == 422)
    {
        email_error.value = "INVALID EMAIL";
    }
}
</script>

<template>
    <LoginForm @submit-form = "submitForm">
        <template #password_error v-if = "password_error"><label for = "password" class = "error">{{ password_error }}</label></template>
        <template #email_error v-if = "email_error"><label for = "email" class = "error">{{ email_error }}</label></template>
    </loginForm>
</template>