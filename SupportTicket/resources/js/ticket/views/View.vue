<script setup lang = "ts">
import { useRoute } from 'vue-router';
import { getTicketByID } from '../store/ticket';
import { getUserByID } from '../../user/store/users';
import { printCategoriesByID } from '../../category/store/category';
import { getResponses, storeResponse } from '../../responses/store/response';
import { computed, ref } from 'vue';
import { getUser } from '../../user/store/user';
import AppointedToMenu from '../components/AppointedToMenu.vue';
import StatusMenu from '../../status/components/StatusMenu.vue';
import { getStatusByID } from '../../status/store/status';
import Navbar from '../../navbar/components/Navbar.vue';
import ResponseForm from '../../responses/components/ResponseForm.vue';
import { IResponse, Response } from '../../responses/types/response';
import NoteForm from '../../note/components/NoteForm.vue';
import { INote, Note } from '../../note/types/note';
import { storeNote, getNotes } from '../../note/store/note';

const ticketID = +useRoute().params.ticketID;
const ticket = getTicketByID(ticketID);
const allResponses = getResponses();
const responses = computed(() => allResponses.value?.filter((response) => response.ticket_id == ticket.value?.id));
const allNotes = getNotes();
const notes = computed(() => allNotes.value?.filter((note) => note.ticket_id == ticket.value?.id).reverse());
const user = getUser();
const note = ref(new Note);
const response = ref(new Response);

const addResponse = async (formResponse: IResponse) => {
    if(!ticket.value?.user_id) return;
    formResponse.ticket_id = ticketID;
    await storeResponse(formResponse, ticket.value?.user_id);
    response.value = new Response;
};

const addNote = async (noteForm: INote) => {
    noteForm.ticket_id = ticketID;
    await storeNote(noteForm);
    note.value = new Note;
}

</script>

<template>
    <Navbar />
    <p id = "ticketInfo" v-if = "ticket">TICKET ID: {{ ticket?.id }} MADE BY: {{ getUserByID(ticket.user_id).value?.full_name }} APPOINTED TO: {{ getUserByID(ticket?.appointed_to_id).value?.full_name }} CREATED AT: {{ ticket?.created_at }} LAST UPDATED AT: {{ ticket?.updated_at }} STATUS: {{ getStatusByID(ticket.status_id).value?.title }} CATEGORIES: {{ printCategoriesByID(ticket?.category_ids) }}</p>
    <p id = "ticketContent">{{ ticket?.content }}</p>
    <AppointedToMenu :ticket = ticket v-if = "user?.is_admin && ticket"/>
    <StatusMenu :ticket = ticket v-if = "user?.is_admin && ticket" />
    <p class = "header" v-if = "user?.is_admin">ADD NOTE HERE</p>
    <NoteForm :note = note v-if = "user?.is_admin" @submit-form = "addNote"/>
    <p class = "header" v-if = "user?.is_admin">NOTES</p>
    <div id = "notes" v-for = "note in notes">
        <p>NOTE MADE BY: {{ getUserByID(note.user_id).value?.full_name }}<br>{{ note.content }}</p>
    </div>
    <p class = "header" v-if = "user?.is_admin">ADD RESPONSE HERE</p>
    <ResponseForm v-if = "user?.is_admin" :response = "response" @submit-form = "addResponse"/>
    <p class = "header">RESPONSES</p>
    <div id = "ticketResponses" v-for = "response in responses">
        <p>{{ response.content }}</p>
        <router-link :to = "{name: 'responseEdit', params: {responseID: response.id} }" v-if = "user?.is_admin">EDIT RESPONSE</router-link>
    </div>
</template>

<style scoped>
#ticketInfo{
    font-size: 14px;
    text-align: center;
}
#ticketContent{
    font-size: 20px;
    width: 60%;
    margin: auto;
    text-align: center;
}
#ticketResponses{
    width: 60%;
    margin: auto;
    text-align: center;
    margin-top: 10px;
}
.header{
    text-align: center;
    font-size: 22px;
    font-weight: bolder;
    margin-bottom: 0px;
}
#notes{
    text-align: center;
    width: 60%;
    margin: auto;
    margin-top: 10px;
}
</style>