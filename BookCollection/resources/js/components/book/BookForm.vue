<script setup lang="ts">
import { computed, ref } from "vue";
import { Book } from "../../types/book";
import { getAuthors, addAuthor } from "../../store/authors";
import AuthorForm from "../author/AuthorForm.vue";
import { Author } from "../../types/author";

const props = defineProps<{
    book: Book;
}>();

const emit = defineEmits(["submitForm"]);

const bookData = { ...props.book };
const search = ref();
const authors = getAuthors();

const searchAuthors = computed(() => {
    if (!search.value) return authors.value;
    // TODO: onderstaande filter functie zou ik in de store als getter plaatsen (zodat je hem
    // makkelijk kunt hergebruiken)
    return authors.value.filter((author) =>
        author.name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const emptyAuthor = <Author>{
    id: NaN,
    name: "",
    created_at: "",
    updated_at: "",
};
const authorData = ref<Author>(Object.assign({}, emptyAuthor));

const onFileChange = (event: any) => (bookData.img = event.target.files[0]);
const onSearchChange = (value: number) => (bookData.author_id = value);
const submitAuthor = async (data: Author) => {
    await addAuthor(data);
    authorData.value = Object.assign({}, emptyAuthor);
};
</script>

<template>
    <form id="bookForm">
        <div id="searchBox">
            <input type="text" placeholder="SEARCH" v-model="search" />
            <div id="searchContent">
                <div v-for="author in searchAuthors">
                    <input
                        type="radio"
                        :id="author.id.toString()"
                        name="search"
                        @click="onSearchChange(author.id)"
                    />
                    <label :for="author.id.toString()">{{ author.name }}</label>
                </div>
            </div>
            <AuthorForm
                :author="authorData"
                @submit-form="submitAuthor"
                id="addAuthor"
            />
        </div>
        <div id="formSection">
            <label for="bookName">BOOK NAME</label><br />
            <input type="text" id="bookName" v-model="bookData.name" /><br />
            <label for="bookImg">BOOK IMAGE</label><br />
            <input type="file" id="bookImg" @change="onFileChange" /><br />
            <input
                type="submit"
                value="SUBMIT"
                @click.prevent="$emit('submitForm', bookData)"
            />
            <slot></slot>
        </div>
    </form>
</template>

<style scoped>
#bookForm {
    margin-top: 10px;
    text-align: center;
}
#searchBox {
    width: fit-content;
    height: fit-content;
    border: 2px solid black;
    margin: auto;
}
#searchBox input[type="text"] {
    width: 100%;
    border-radius: 0px;
    outline: 0px;
}
#searchContent {
    height: fit-content;
    overflow-y: scroll;
    text-align: left;
    max-height: 100px;
}
#searchContent div {
    padding: 2px;
    padding-right: 4px;
}
#formSection {
    margin-top: 10px;
}
#formSection input {
    margin: 5px 10px 10px 10px;
}
</style>

<style>
#addAuthor {
    margin-bottom: 0px;
    margin-top: 0px;
}
#addAuthor input {
    border-radius: 0px;
    outline: 0px;
    width: max-content;
    display: inline;
    margin: auto;
}
</style>
