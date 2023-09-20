import axios from "../../api";
import { computed, ref } from "vue";
import { Status } from "../types/status";

const statuses = ref<Status[]>();

export const getAllStatuses = async () => {
    const {data} = await axios.get("/api/statuses/index");
    if(!data) return
    statuses.value = data;
}

export const getStatuses = () => computed(() => statuses.value);

export const getStatusByID = (id: number) => computed(() => statuses.value?.find((status) => status.id == id));