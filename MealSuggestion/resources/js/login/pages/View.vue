<script setup lang="ts">
import LoginForm from '../components/LoginForm.vue';
import {logUserIn} from '../store/authentication';
</script>

<template>
    <div class="mt-3 text-center">
        <LoginForm @submit-form="logUserIn" />

        <router-link :to="{name: 'loginForgot'}" class="btn btn-secondary fs-5 mt-3">FORGOT PASSWORD</router-link>

        <br />

        <router-link :to="{name: 'userCreate'}" class="btn btn-secondary fs-5 mt-3">CREATE ACCOUNT</router-link>
    </div>
</template>
