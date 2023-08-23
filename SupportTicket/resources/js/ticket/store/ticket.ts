import axios from "axios";
import { computed, ref } from "vue";
import { Ticket } from "../types/ticket";

const tickets = ref<Ticket[]>();

export const getAllTickets = async () => {
    const {data} = await axios.get("/api/getTickets");
    if(!data) return
    tickets.value = data;
}

export const getTickets = () => computed(() => tickets.value);

export const ticketTimeFormatter = (time: string) =>{
    time = time.replace("T", "");
    time = time.replace(".000000Z", "");
    return time
}