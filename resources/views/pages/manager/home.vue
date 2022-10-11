<template layout>
    <Head>
        <title>Manager</title>
    </Head>
<div class="mt-5 p-5 flex h-screen place-content-center">
    <div class="self-center grid place-items-center ">
        <h6 class="text-2xl font-medium">This is the manager home page</h6>
        <!---remember to create manager profile update after adding layout-->
        <Link href="/manager/auth/logout"
              method="post" as="button" class="px-3 bg-sky-800 py-4 text-white hover:bg-sky-600">
            <span class="mr-3"><i class="fal fa-lock"></i></span>Log Out</Link>
    </div>
</div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
</script>

<style scoped>

</style>
