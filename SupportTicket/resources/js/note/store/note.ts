import { computed, ref } from "vue";
import { INote } from "../types/note";
import axios from "../../api";

const notes = ref<INote[]>()

export const getAllNotes = async () => {
    const {data} = await axios.get("/api/notes/index");
    if(!data) return
    notes.value = data;
}

export const getNotes = () => computed(() => notes.value);

export const storeNote = async (note: INote) => {
    const {data} = await axios.post("/api/notes/store", {content: note.content, ticket_id: note.ticket_id});
    if(!data) return
    notes.value = data;
}

export const removeNoteStore = () => notes.value = [];