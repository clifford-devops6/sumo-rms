<template layout>
<div class="mt-5 p-5">
    <h6>This is the manager home page</h6>
    <Link href="/manager/auth/logout"
          method="post" as="button" class="px-3 bg-sky-800 py-4 text-white hover:bg-sky-600">
        <span class="mr-3"><i class="fal fa-lock"></i></span>Log Out</Link>
</div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
</script>

<style scoped>

</style>
