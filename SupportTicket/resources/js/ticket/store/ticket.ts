import axios from "../../api";
import { ComputedRef, computed, ref } from "vue";
import { Ticket } from "../types/ticket";

const tickets = ref<Ticket[]>();

export const getAllTickets = async () => {
    const { data } = await axios.get("/api/tickets/index");
    if (!data) return;
    tickets.value = data;
};

export const getTickets = () => computed(() => tickets.value);

// TODO: destruct de 3 benodigde parameters mbv object destructuring
export const storeTicket = async (ticket: Ticket) => {
    const { data } = await axios.post("/api/tickets/store", {
        title: ticket.title,
        content: ticket.content,
        category_ids: ticket.category_ids,
    });
    if (!data) return;
    tickets.value = data;
};

export const getTicketByID = (id: number): ComputedRef<Ticket | undefined> =>
    computed(() => tickets.value?.find((ticket) => ticket.id == id));

export const updateTicket = async (ticket: Ticket) => {
    const { data } = await axios.patch("/api/tickets/update/" + ticket.id, {
        title: ticket.title,
        content: ticket.content,
        category_ids: ticket.category_ids,
    });
    if (!data) return;
    tickets.value = data;
};

export const updateAppointedTo = async (userID: number, ticketID: number) => {
    const { data } = await axios.patch(
        "/api/tickets/updateAppointedTo/" + ticketID,
        { appointed_to_id: userID }
    );
    if (!data) return;
    tickets.value = data;
};

export const updateStatus = async (statusID: number, ticketID: number) => {
    const { data } = await axios.patch(
        "/api/tickets/updateStatus/" + ticketID,
        { status_id: statusID }
    );
    if (!data) return;
    tickets.value = data;
};

export const removeTicketStore = async () => (tickets.value = []);
