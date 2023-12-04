<script setup lang="ts">
import type {Category} from '../types/category';

import {getCategories} from '../store/category';

const emit = defineEmits<{
    (event: 'pressCategory', category: Category): void;
}>();

const categories = getCategories();
</script>

<template>
    <div class="border border-3 overflow-y-hidden rounded" style="height: 100px">
        <div class="h-100 overflow-y-auto">
            <div v-for="category in categories" :key="category.id">
                <label :for="category.name" class="ms-1">{{ category.name }}</label>

                <input
                    :id="category.name"
                    class="me-1 ms-1"
                    type="radio"
                    name="category"
                    @click="emit('pressCategory', category)"
                />
            </div>
        </div>
    </div>
</template>
