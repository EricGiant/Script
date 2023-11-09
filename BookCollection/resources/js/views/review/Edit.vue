<script setup lang="ts">
import { useRoute } from "vue-router";
import ReviewForm from "../../components/review/ReviewForm.vue";
import { getReviewById, updateReview, deleteReview } from "../../store/reviews";
import { router } from "../../router";
import { Review } from "../../types/review";

// TODO: evt. kun je de casting met + vervangen voor casting in de route file zelf, zie:
// https://stackoverflow.com/questions/49924450/vue-router-how-to-cast-params-as-integers-instead-of-strings
const reviewData = getReviewById(+useRoute().params.reviewID);

const submitReview = async (data: Review) => {
    await updateReview(data);
    router.back();
};

const deleteReviewFunc = async () => {
    await deleteReview(reviewData.value.id);
    router.back();
};
</script>

<template>
    <ReviewForm
        :review="reviewData"
        @submit-form="submitReview"
        v-if="reviewData"
    >
        <button @click.prevent="deleteReviewFunc">DELETE</button>
    </ReviewForm>
</template>
