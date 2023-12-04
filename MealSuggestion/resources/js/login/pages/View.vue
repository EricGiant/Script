<script setup lang="ts">
import LoginForm from '../components/LoginForm.vue';
import {logUserIn} from '../store/authentication';
</script>

<template>
    <div class="col-md mt-3 text-center">
        <LoginForm @submit-form="logUserIn" />

        <router-link :to="{name: 'userCreate'}" class="btn btn-secondary fs-5 mt-3">CREATE ACCOUNT</router-link>
    </div>
</template>
