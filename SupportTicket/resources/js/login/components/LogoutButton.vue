<script setup lang = "ts">
import { router } from "../../router";
import { logout } from "../store/authentication";
import { removeUserStore } from "../../user/store/user";
import { removeNoteStore } from "../../note/store/note";

const onLogout = () =>{
    logout();
    removeUserStore();
    removeNoteStore();
    router.push({name: "login"});
};
</script>

<template>
    <button @click.prevent = "onLogout">LOGOUT</button>
</template>