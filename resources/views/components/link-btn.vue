<template>
    <Link :href="href"><slot></slot></Link>

</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    href:String
})
</script>

<style scoped>

</style>
