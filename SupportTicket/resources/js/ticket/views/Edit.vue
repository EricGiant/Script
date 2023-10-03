<script setup lang = "ts">
import { useRoute } from 'vue-router';
import TicketForm from '../components/TicketForm.vue';
import { getTicketByID, updateTicket } from '../store/ticket';
import { router } from '../../router';
import { Ticket } from '../types/ticket';
import AppointedToMenu from '../components/AppointedToMenu.vue';
import { getUser } from '../../user/store/user';
import StatusMenu from '../../status/components/StatusMenu.vue';
import Navbar from '../../navbar/components/Navbar.vue';

const ticket = getTicketByID(+useRoute().params.ticketID);
const user = getUser();

const submitTicket = async (ticket: Ticket) => {
    await updateTicket(ticket);
    router.push({name: "ticketOverview"});
}
</script>

<template>
    <Navbar />
    <TicketForm :ticket = "ticket" @submit-form = "submitTicket" v-if = "ticket"/>
    <AppointedToMenu :ticket = ticket v-if = "ticket && user?.is_admin" />
    <StatusMenu :ticket = ticket v-if = "ticket && user?.is_admin" />
</template>