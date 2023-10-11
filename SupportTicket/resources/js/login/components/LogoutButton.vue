<script setup lang = "ts">
import { router } from "../../router";
import { logout, unloadAssets } from "../store/authentication";

const onLogout = async () =>{
    await unloadAssets();
    await logout();
    router.push({name: "login"});
};
</script>

<template>
    <button @click.prevent = "onLogout">LOGOUT</button>
</template>