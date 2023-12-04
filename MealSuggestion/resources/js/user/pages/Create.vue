<script setup lang="ts">
import {logUserIn} from '@/login/store/authentication';

import UserForm from '../components/UserForm.vue';
import {createUser} from '../store/user';
import {UserAccount} from '../types/userAccount';

const user = new UserAccount();

const createAccount = async (userAccount: UserAccount) => {
    await createUser(userAccount);
    await logUserIn(userAccount);
};
</script>

<template>
    <div class="mt-3 text-center">
        <UserForm :user-account="user" @submit-form="createAccount" />

        <router-link :to="{name: 'loginView'}" class="btn btn-secondary fs-5 mt-3">BACK TO LOGIN</router-link>
    </div>
</template>
