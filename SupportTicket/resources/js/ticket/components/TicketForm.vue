<script setup lang = "ts">
import { getCategories } from '../../category/store/category';
import { computed, ref } from 'vue';
import { Ticket } from '../types/ticket';

const props = defineProps<{
    ticket: Ticket,
}>();

const emits = defineEmits(["submitForm"]);

const allCategories = getCategories();
const ticket = {...props.ticket};
const categorySearch = ref();
const categories = computed(() => {
    if(!categorySearch.value) return allCategories.value;
    return allCategories.value?.filter((category) => category.title.toLowerCase().includes(categorySearch.value.toLowerCase()));
})

const categoryChange = (id: number) => {
    if(ticket.category_ids.includes(id))
    {
        const index = ticket.category_ids.findIndex((categoryID) => categoryID == id );
        ticket.category_ids.splice(index, index + 1);
    }
    else
    {
        ticket.category_ids.push(id);
    }
}

const checkCheckBox = (id: number) => {
    if(ticket.category_ids.includes(id))
    {
        return true;
    }
    else
    {
        return false
    }
}
</script>

<template>
    <form>
        <div id = "categoryBox">
            <input type = "text" placeholder = "SEARCH" v-model = "categorySearch">
            <div id = "categoryBoxWindow">
                <div v-for = "category in categories">
                    <input type = "checkbox" name = "categories[]" :id = category.id.toString() @click = "categoryChange(category.id)" :checked = "checkCheckBox(category.id)"> 
                    <label :for = category.id.toString()>{{ category.title }}</label>
                </div>
            </div>
        </div>
        <label for = "title">TITLE</label>
        <input type = "text" id = "title" v-model = "ticket.title">
        <label for = "content">CONTENT</label>
        <textarea id = "content" v-model = "ticket.content"></textarea>
        <input type = "submit" @click.prevent = "$emit('submitForm', ticket)">
    </form>
</template>

<style scoped>
#categoryBox{
    width: max-content;
    height: max-content;
    margin: auto;
    border: 2px solid black;
    margin-bottom: 5px;
}
#categoryBox input[type = text]{
    outline: 0px;
    border: 2px solid black;
    border-radius: 0px;
    margin-bottom: 0px;
    width: 100%;
}
#categoryBoxWindow
{
    height: fit-content;
    overflow-y: scroll;
    text-align: left;
    max-height: 100px;
}
#categoryBoxWindow label{
    display: inline;
}
form textarea{
    resize: none;
    width: 500px;
    height: 200px;
    margin-bottom: 5px;
}
</style>