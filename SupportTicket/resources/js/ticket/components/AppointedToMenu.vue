<script setup lang = "ts">
import { ref, computed } from 'vue';
import { getAdminUsers, getUserByID } from '../../user/store/users';
import { updateAppointedTo } from '../store/ticket';
import { Ticket } from '../types/ticket';

const props = defineProps<{
    ticket: Ticket
}>();

const userSearch = ref();
const adminUsers = getAdminUsers();
const users = computed(() => {
    if(!userSearch.value) return adminUsers.value;
    return adminUsers.value?.filter((user) => user.full_name.toLowerCase().includes(userSearch.value.toLowerCase()))
})
</script>

<template>
    <p id = "appointedHeader">APPOINT TICKET TO</p>
    <p id = "appointedUnderHeader">CURRENTLY APPOINTED: {{ getUserByID(ticket.appointed_to_id).value?.full_name }}</p>
    <div id = "userBox">
        <input type = "text" placeholder = "SEARCH" v-model = "userSearch">
        <div id = "userBoxWindow">
            <button @click.prevent = "updateAppointedTo(user.id, ticket.id)" v-for = "user in users">{{ user.full_name }}</button>
        </div>
    </div>
</template>

<style scoped>
#userBox{
    width: max-content;
    height: max-content;
    margin: auto;
    border: 2px solid black;
    margin-bottom: 5px;
}
#userBox input[type = text]{
    width: 100%;
    outline: 0px;
    border: 2px solid black;
    border-radius: 0px;
    margin-bottom: 0px;
}
#userBoxWindow{
    height: fit-content;
    overflow-y: scroll;
    text-align: left;
    max-height: 100px;
}
#userBoxWindow button{
    margin: auto;
    display: block;
    border: 0px;
    background-color: white;
    padding: 2px;
}
#userBoxWindow button:hover{
    background-color: lightgrey;
}
#appointedHeader{
    text-align: center;
    font-size: 22px;
    font-weight: bolder;
    margin-bottom: 0px;
}
#appointedUnderHeader{
    margin-top: 0px;
    text-align: center;
    font-size: 18px;
}
</style>