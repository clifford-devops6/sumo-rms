<template layout>
    <Head>
        <title>Unit Manager</title>
    </Head>
    <div className="mt-5 p-5 flex h-screen place-content-center">
        <div className="self-center grid place-items-center ">
            <h6 className="text-2xl font-medium">This is the Unit Manager home page</h6>
            <!---remember to create manager profile update after adding layout-->
            <Link href="/caretaker/auth/logout"
                  method="post" as="button" class=" mt-8 btn-primary">
                <span className="mr-3"><i className="fal fa-lock"></i></span>Log Out
            </Link>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
</script>

<style scoped>

</style>
