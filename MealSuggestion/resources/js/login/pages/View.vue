<script setup lang="ts">
import type {Login} from '../types/login';

import {getErrorsAsSingleString} from '@/error/store/error';
import {router} from '@/router';

import LoginForm from '../components/LoginForm.vue';
import {authenticateUser, loadAssets} from '../store/authentication';

const logUserIn = async (login: Login) => {
    const data = await authenticateUser(login);
    if (data) {
        await loadAssets();
        router.push({name: 'homeOverview'});
        // eslint-disable-next-line no-alert
    } else if (!data) alert(getErrorsAsSingleString());
};
</script>

<template>
    <LoginForm @submit-form="logUserIn" />
</template>
