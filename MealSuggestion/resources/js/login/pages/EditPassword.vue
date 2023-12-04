<script setup lang="ts">
import {useRoute} from 'vue-router';

import {router} from '@/router';
import {updateUserPassword} from '@/user/store/user';

import EditPasswordForm from '../components/EditPasswordForm.vue';

const {token} = useRoute().params;

const updatePassword = async (password: string) => {
    await updateUserPassword(password, <string>token);
    router.push({name: 'loginView'});
};
</script>

<template>
    <EditPasswordForm class="mt-3" @submit-form="updatePassword" />
</template>
