<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const errors = computed(() => usePage().props.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div v-if="hasErrors">

        <div v-for="(error, key) in errors" :key="key" class="alert border-0 border-danger border-start border-4 bg-light-danger alert-dismissible fade show py-2 radius-10">
            <div class="d-flex align-items-center">
                <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i></div>
                <div class="ms-3">
                    <div class="text-danger">{{ error }}</div>
                </div>
            </div>
        </div>

    </div>
</template>
