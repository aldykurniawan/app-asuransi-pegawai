<template>
    <nav aria-label="Pagination" >
        <ul class="pagination">
            <li @click="toTop" class="page-item" 
                v-for="(link, key) in links" :key="key" 
                v-bind:class="isActive(link)"
            >
                <Link preserve-scroll class="page-link" :href="link.url" v-if="link.url"><div v-html="link.label"/></Link>
                <a class="page-link" href="#" v-else @click.prevent="handleNoLink"><div v-html="link.label"/></a>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue';

const props = defineProps({
    links: {
        type: Array,
        default: () => ({}),
    },
});

const showPagination = computed(() => {
    return props.links.length > 3
});

const isActive = (link) => {
    return (link.active === true) ? 'active' : 'normal'
};

const handleNoLink = () => {
    return false;
};

const toTop = () => {
    window.scrollTo(0,0);
};

</script>
