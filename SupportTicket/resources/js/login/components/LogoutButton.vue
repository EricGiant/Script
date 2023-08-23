<script setup lang = "ts">
import { router } from "../../router";
import { logout } from "../store/authentication";
import { removeUserStore } from "../../user/store/user";

const onLogout = () =>{
    logout();
    removeUserStore();
    router.push({name: "login"})
}
</script>

<template>
    <button @click.prevent = "onLogout">LOGOUT</button>
</template>