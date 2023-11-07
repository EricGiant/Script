<script setup lang="ts">
import LoginForm from "../pages/components/LoginForm.vue";
import { Login } from "./types/login";
import { authenticateUser, loadAssets } from "../store/authentication";
import { getErrorsAsSingleString } from "../../error/store/error";
import { router } from "../../router";

const logUserIn = async (login: Login) => {
    const data = await authenticateUser(login);
    if (data) {
        await loadAssets();
        router.push({ name: "homeOverview" });
    } else if (!data) {
        alert(getErrorsAsSingleString());
    }
};
</script>

<template>
    <LoginForm @submit-form="logUserIn" />
</template>
