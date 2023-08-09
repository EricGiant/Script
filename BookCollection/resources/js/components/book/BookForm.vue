<script setup lang = "ts">
import Search from '../search/Search.vue';
import { addAuthor, getAuthors } from '../../store/author';
import { ref } from 'vue';
import { Book } from '../../types/book';

const props = defineProps<{
    bookData: Book
}>();

const authors = getAuthors();
const newAuthor = ref("");

const submitAuthor = async () => {
    await addAuthor(newAuthor.value);
    newAuthor.value = "";
}

const onSearchChange = (value: number) => props.bookData.author_id = value;
// @ts-ignore comment this works fine but typescript is just being odd about it
const onFileChange = (event: Event) => props.bookData.img = event.target.files[0];
</script>

<template>
    <form id = "bookForm">
        <Search :input = "authors" @searchValue = "onSearchChange">
            <form id = "addAuthor">
                <input type ="text" placeholder = "ADD AUTHOR" v-model = "newAuthor">
                <input type = "submit" value = "ADD" @click.prevent = "submitAuthor">
            </form>
        </Search>
        <div id = "bookInputs">
            <label for = "bookName">BOOK NAME</label><br>
            <input type = "text" name = "bookName" v-model = "props.bookData.name"><br>
            <label for = "bookImage">BOOK IMAGE</label><br>
            <input type = "file" name = "bookImage" @change = "onFileChange"><br>
        </div>
        <div id = "bookSlot"><slot></slot></div>
    </form>
</template>

<style scoped>
#addAuthor{
    margin-bottom: 0px;
}
#addAuthor input[type=text]{
    border-radius: 0px;
    outline: 0px;
}
#addAuthor input[type=submit]{
    border-radius: 0px;
}
#bookForm{
    text-align: center; width: 80%; margin: auto; margin-top: 20px;
}
#bookInputs{
    margin-top: 10px;
}
#bookInputs input[type=text]{
    margin: 5px 10px 10px 10px;
}
#bookSlot{
    margin-top: 15px;
}
</style>