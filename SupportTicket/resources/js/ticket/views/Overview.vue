<script setup lang = "ts">
import { computed } from 'vue';
import { getStatusByID } from '../../status/store/status';
import { getUserByID } from '../../user/store/users';
import { getTickets } from '../store/ticket';
import { printCategoriesByID } from '../../category/store/category';
import Navbar from '../../navbar/components/Navbar.vue';

const allTickets = getTickets();

const tickets = computed(() => {
    if(!allTickets.value) return
    return [...allTickets.value].reverse();
});

const appointedUserCheck = (id: number) => {
    if(id == null)
    {
        return "NOT APPOINTED YET"
    }
    else
    {
        return getUserByID(id).value?.full_name;
    }
}
</script>

<template>
    <Navbar />
    <table>
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>CATEGORIEËN</th>
            <th>STATUS</th>
            <th>AANGEMAAKT DOOR</th>
            <th>AANGEMAAKT OP</th>
            <th>LAATSE UPDATE OP</th>
            <th>TOEGEWEZEN AAN</th>
        </tr>
        <tr v-for = "ticket in tickets">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ printCategoriesByID(ticket.category_ids) }}</td>
            <td>{{ getStatusByID(ticket.status_id).value?.title }}</td>
            <td>{{ getUserByID(ticket.user_id).value?.full_name }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ appointedUserCheck(ticket.appointed_to_id) }}</td>
            <td><router-link :to = "{name: 'ticketView', params: {ticketID: ticket.id}}">VIEW TICKET</router-link></td>
            <td><router-link :to = "{name: 'ticketEdit', params: {ticketID: ticket.id}}">EDIT TICKET</router-link></td>
        </tr>
    </table>
</template>

<style scoped>
table{
    text-align: center;
    margin: auto;
}
</style>