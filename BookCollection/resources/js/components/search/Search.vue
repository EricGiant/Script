<script setup lang = "ts">
import { computed, ref } from 'vue';

const props = defineProps<{
    input: Array<any>,
}>();

const search = ref();
const searchInput = computed(() => {
    if(!search.value) return props.input;
    return props.input.filter((input: {name: string}) => input.name.toLowerCase().includes(search.value.toLowerCase()));
})

</script>
<template>
    <div id = "searchBox">
        <div id = "searchText">
            <input type = "text" placeholder = "SEARCH" v-model = "search" form = "NO_FORM">
        </div>
        <div id = "searchContent">
            <div v-for = "input in searchInput">
                <input type = "radio" :value = "input.id" name = "searchValue" @click = "$emit('searchValue', input.id)">
                <label :for = "input.id">{{ input.name }}</label>
            </div>
        </div>
        <slot></slot>
    </div>
</template>

<style scoped>
#searchBox{
    width: fit-content;
    height: fit-content;
    border: 2px solid black;
    margin: auto;
}
#searchText input{
    width: 100%;
    border-radius: 0px;
    outline: 0px;
}
#searchContent{
    height: fit-content;
    overflow-y: scroll;
    text-align: left;
    max-height: 100px;
}
#searchContent div{
    padding: 2px;
    padding-right: 4px;
}
</style>