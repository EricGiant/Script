<script setup lang = "ts">
import Navbar from '../../navbar/components/Navbar.vue';
import { router } from '../../router';
import TicketForm from '../components/TicketForm.vue';
import { storeTicket } from '../store/ticket';
import { Ticket } from '../types/ticket';

const ticket = {
    id: NaN,
    title: "",
    content: "",
    user_id: NaN,
    status_id: NaN,
    appointed_to_id: NaN,
    created_at: "",
    updated_at: "",
    category_ids: []
}

const submitTicket = async (data: Ticket) => {
    await storeTicket(data);
    router.push({name: "ticketOverview"});
}
</script>

<template>
    <Navbar />
    <TicketForm :ticket = "ticket" @submit-form = "submitTicket"/>
</template>