<template>
<div class="py-1">
    <Link :href="href" class="hover:text-sky-800 font-medium text-md"><slot></slot></Link>
</div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    href:String
})
</script>


