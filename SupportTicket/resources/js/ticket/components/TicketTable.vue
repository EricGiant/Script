<script setup lang = "ts">
import { getUser } from '../../user/store/user';
import { getTickets, ticketTimeFormatter } from "../store/ticket";

const user = getUser();
const tickets = getTickets();
</script>

<template>
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
            <td>{{"CATO"}}</td>
            <td>{{"STATUS"}}</td>
            <td>{{ ticket.user_id }}</td>
            <td>{{ ticketTimeFormatter(ticket.created_at) }}</td>
            <td>{{ ticketTimeFormatter(ticket.updated_at) }}</td>
            <td>{{"TO"}}</td>
        </tr>
    </table>
</template>