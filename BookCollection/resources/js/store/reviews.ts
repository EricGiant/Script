import axios from "axios";
import { ref } from "vue";

const reviews = ref<review[]>([]);

interface review {
    id: number,
    book_id: number,
    content: string;
}

export const getAllReviews = async () => {
    const {data} = await axios.get("/api/getReviews");
    if(!data) return
    reviews.value = data;
}

export const getReviewsByBookId = (id: number) => reviews.value.filter((review) => review.book_id == id);