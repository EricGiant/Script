import { computed, ref } from "vue";
import { Response } from "../types/response";
import axios from "../../api";

const responses = ref<Response[]>();

export const getAllResponses = async () => {
    const {data} = await axios.get("/api/responses/index");
    if(!data) return
    responses.value = data;
}

export const getResponses = () => computed(() => responses.value);

export const storeResponse = async (response: Response, ticket_userID: number) => {
    const {data} = await axios.post("/api/responses/store", {content: response.content, ticket_id: response.ticket_id, ticket_userID: ticket_userID});
    if(!data) return
    responses.value = data;
}

export const getResponseByID = (id: number) => computed(() => responses.value?.find((response) => response.id == id));

export const updateResponse = async (response: Response) => {
    const {data} = await axios.patch("/api/responses/update/" + response.id, {content: response.content});
    if(!data) return
    responses.value = data;
}