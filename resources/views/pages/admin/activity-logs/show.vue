<template>
<admin>
    <Head><title>Activity Logs</title></Head>
    <admin-navbar><template #header>Activity Logs</template></admin-navbar>
    <div class="pt-14">
        <div class="grid lg:grid-cols-4">
            <div class="lg:col-span-1 p-5 grid border">
                <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                    <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
                </div>
                <div class=" mt-5">
                    <h6 class="capitalize font-semibold">{{activity.causer.name}} {{activity.causer.last_name}}</h6>
                    <p>Email: <span class="text-sky-800">{{activity.causer.email}}</span></p>
                    <p>Cellphone: <span class="text-sky-800">{{activity.causer.cellphone}}</span></p>
                    <p>Action Date: <span class="text-sky-800">{{(new Date(activity.created_at).toDateString())}}</span></p>


                </div>
            </div>
            <div class="lg:col-span-3 grid">
                <div class="border overflow-hidden">
                    <div class="border-b py-5 px-5 bg-sky-50">
                        <h1 class="font-semibold text-xl">Activity</h1>
                    </div>
                    <div class="py-5 px-5">
                        <h6 class="font-medium text-sky-800 capitalize">{{activity.log_name}}</h6>
                        <p>{{activity.description}}</p>
                        <p>Logged on: <span class="text-sky-800">{{(new Date(activity.created_at).toDateString())}}</span></p>


                    </div>
                </div>

                <div class="border overflow-hidden">
                    <div class="border-b py-5 px-5 bg-sky-50">
                        <h1 class="font-semibold text-xl">Activity Subject</h1>
                    </div>
                    <div class="py-5 px-5 bg-gray-50">
                        {{activity.subject}}
                    </div>
                </div>


            </div>

        </div>
    </div>
    <template #sidebar>
        <Link href="/admin/activity-logs" class="mt-5 text-sky-800 font-medium"><p><span class="self-center mr-2"><i class="fal fa-angle-right"></i></span>Activity Logs </p></Link>
    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import AdminNavbar from "@/views/components/admin-navbar.vue";
import Admin from "@/views/layouts/admin.vue";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
    activity:Object
})
</script>

<style scoped>

</style>
