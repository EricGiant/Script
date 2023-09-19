<script setup lang = "ts">
import { getStatuses, getStatusByID } from '../store/status';
import { Ticket } from '../../ticket/types/ticket';
import { updateStatus } from '../../ticket/store/ticket';

const props = defineProps<{
    ticket: Ticket
}>();

const statuses = getStatuses();
</script>

<template>
    <p id = "statusHeader">CHANGE TICKET STATUS</p>
    <p id = "statusUnderHeader">CURRENT STATUS: {{ getStatusByID(ticket.status_id).value?.title }}</p>
    <div id = "statusBox">
        <button @click.prevent = "updateStatus(status.id, ticket.id)" v-for = "status in statuses">{{ status.title }}</button>
    </div>
</template>

<style>
#statusBox{
    width: max-content;
    height: max-content;
    margin: auto;
    border: 2px solid black;
    margin-bottom: 5px;
}
#statusBox button{
    margin: auto;
    border-width: 1px;
    background-color: white;
    padding: 2px;
}
#statusBox button:hover{
    background-color: lightgrey;
}
#statusHeader{
    text-align: center;
    font-size: 22px;
    font-weight: bolder;
    margin-bottom: 0px;
}
#statusUnderHeader{
    margin-top: 0px;
    text-align: center;
    font-size: 18px;
}
</style>