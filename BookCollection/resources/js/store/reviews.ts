import axios from "axios";
import { ref, computed, ComputedRef } from "vue";
import { Review } from "../types/review";

const reviews = ref<Review[]>([]);

export const getAllReviews = async () => {
    const {data} = await axios.get("/api/getReviews");
    if(!data) return
    reviews.value = data;
}

export const getReviewsByBookId = (id: number) => computed(() => reviews.value.filter((review) => review.book_id == id));

export const getReviewById = (id: number): ComputedRef => computed(() => reviews.value.find((review) => review.id == id));

export const addReview = async (review: Review) => {
    const {data} = await axios.post("/api/addReview", {content: review.content, book_id: review.book_id});
    if(!data) return
    reviews.value = data;
}

export const updateReview = async (review: Review) => {
    const {data} = await axios.patch("/api/updateReview/" + review.id, {content: review.content});
    if(!data) return
    reviews.value = data;
}

export const deleteReview =async (id: number) => {
    const {data} = await axios.delete("/api/deleteReview/" + id);
    if(!data) return
    reviews.value = data;
}