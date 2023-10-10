import { computed, ref } from "vue";
import { IResponse } from "../types/response";
import axios from "../../api";
import { getTickets } from "../../ticket/store/ticket";

const responses = ref<IResponse[]>();

export const getAllResponses = async () => {
    const {data} = await axios.get("/api/responses/index");
    if(!data) return
    responses.value = data;
}

export const getResponses = () => computed(() => responses.value);

export const storeResponse = async (response: IResponse, ticket_userID: number) => {
    const {data} = await axios.post("/api/responses/store/" + response.ticket_id, {content: response.content, ticket_user_id: ticket_userID});
    if(!data) return
    responses.value = data;
}

export const getResponseByID = (id: number) => computed(() => responses.value?.find((response) => response.id == id));

export const updateResponse = async (response: IResponse) => {
    const {data} = await axios.patch("/api/responses/update/" + response.id, {content: response.content});
    if(!data) return
    responses.value = data;
}