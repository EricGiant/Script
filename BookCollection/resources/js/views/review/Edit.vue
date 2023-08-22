<script setup lang = "ts">
import { useRoute } from 'vue-router';
import ReviewForm from '../../components/review/ReviewForm.vue';
import { getReviewById, updateReview, deleteReview } from '../../store/reviews';
import { router } from '../../router';
import { Review } from '../../types/review';

const reviewData = getReviewById(+useRoute().params.reviewID);

const submitReview = async (data: Review) => {
    await updateReview(data);
    router.back();
}

const deleteReviewFunc = async () => {
    await deleteReview(reviewData.value.id);
    router.back();
}
</script>

<template>
    <ReviewForm :review = "reviewData" @submit-form = "submitReview" v-if = "reviewData">
        <button @click.prevent = "deleteReviewFunc">DELETE</button>
    </ReviewForm>
</template>