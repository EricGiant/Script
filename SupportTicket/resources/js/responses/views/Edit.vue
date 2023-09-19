<script setup lang = "ts">
import { useRoute } from 'vue-router';
import ResponseForm from '../components/ResponseForm.vue';
import { getResponseByID, updateResponse as updateResponseFunc } from '../store/response';
import { Response } from '../types/response';
import { router } from '../../router';
import Navbar from '../../navbar/components/navbar.vue';

const response = getResponseByID(+useRoute().params.responseID);

const updateResponse = async (response: Response) => {
    await updateResponseFunc(response);
    router.push({name: "ticketView", params: {ticketID: response.ticket_id}});
}
</script>

<template>
    <Navbar />
    <p>EDIT RESPONSE</p>
    <ResponseForm :response = "response" @submit-form = "updateResponse" v-if = "response"/>
</template>

<style scoped>
p{
    text-align: center;
    font-size: 22px;
    font-weight: bolder;
    margin-bottom: 0px;
}
a{
    text-align: center;
    display: block;
}
</style>