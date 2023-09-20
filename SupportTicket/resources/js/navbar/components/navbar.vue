<script setup>
import LogoutButton from '../../login/components/LogoutButton.vue';
import { getUser } from '../../user/store/user';

const user = getUser();
</script>

<template>
    <nav>
        <router-link :to = "{name: 'ticketOverview'}">HOME</router-link>
        <router-link :to = "{name: 'ticketCreate'}">CREATE TICKET</router-link>
        <router-link :to = "{name: 'categoryOverview'}" v-if = "user?.is_admin">CATEGORY OVERVIEW</router-link>
        <router-link :to = "{name: 'categoryCreate'}" v-if = "user?.is_admin">CREATE CATEGORY</router-link>
        <logout-button />
    </nav>
</template>

<style>
nav{
    text-align: center;
}
a{
    padding: 5px;
}
</style>