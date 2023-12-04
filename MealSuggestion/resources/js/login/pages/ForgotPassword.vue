<script setup lang="ts">
import ForgotPasswordForm from '../components/ForgotPasswordForm.vue';
import {forgotPassword} from '../store/authentication';

const submitForm = async (email: string) => {
    await forgotPassword(email);
    // eslint-disable-next-line no-alert
    alert(`AN EMAIL WITH A RESET LINK HAS BEEN SEND TO: ${email}`);
};
</script>

<template>
    <ForgotPasswordForm class="mt-3" @submit-form="submitForm" />
</template>
