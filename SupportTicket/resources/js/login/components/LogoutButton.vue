<script setup lang = "ts">
import { router } from "../../router";
import { logout } from "../store/authentication";
import { removeUserStore } from "../../user/store/user";
import { removeNoteStore } from "../../note/store/note";

const onLogout = async () =>{
    removeUserStore();
    removeNoteStore();
    await logout();
    router.push({name: "login"});
};
</script>

<template>
    <button @click.prevent = "onLogout">LOGOUT</button>
</template>