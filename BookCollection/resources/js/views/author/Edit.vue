<script setup lang="ts">
import { useRoute } from "vue-router";
import { getAuthorById, updateAuthor, deleteAuthor } from "../../store/authors";
import AuthorForm from "../../components/author/AuthorForm.vue";
import { Author } from "../../types/author";
import { router } from "../../router";

// TODO route param in aparte ref zetten en hergebruiken
const authorData = getAuthorById(+useRoute().params.authorID);

const submitAuthor = async (data: Author) => {
    await updateAuthor(data);
    router.push({ name: "authorOverview" });
};

const deleteAuthorFunc = async () => {
    await deleteAuthor(authorData.value.id);
    router.push({ name: "authorOverview" });
};
</script>

<template>
    <AuthorForm
        :author="authorData"
        @submit-form="submitAuthor"
        v-if="authorData"
    >
        <template #label
            ><label for="authorName">AUTHOR NAME</label><br
        /></template>
        <template #button
            ><button @click.prevent="deleteAuthorFunc">DELETE</button></template
        >
    </AuthorForm>
</template>
