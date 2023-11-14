import type {Category} from '../types/category';

import axios from 'axios';
import {computed, ref} from 'vue';

const categories = ref<Category[]>();

export const setCategories = async () => {
    const {data} = await axios.get('/api/getCategories');
    if (!data) return;
    categories.value = data;
};

export const unloadCategories = () => (categories.value = []);

export const getCategories = () => computed(() => categories.value);
