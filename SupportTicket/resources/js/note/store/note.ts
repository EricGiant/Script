import { computed, ref } from "vue";
import { Note } from "../types/notes";
import axios from "../../api";

const notes = ref<Note[]>()

export const getAllNotes = async () => {
    const {data} = await axios.get("/api/notes/index")
    if(!data) return
    notes.value = data;
}

export const getNotes = () => computed(() => notes.value);

export const storeNote = async (note: Note) => {
    const {data} = await axios.post("/api/notes/store", {content: note.content, ticket_id: note.ticket_id});
    if(!data) return
    notes.value = data;
}

export const removeNoteStore = () => notes.value = [];