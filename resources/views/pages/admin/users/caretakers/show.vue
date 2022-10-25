
<template >
    <admin>
        <div class="relative">
            <Head>
                <title>{{caretaker.name}}</title>
                <meta head-key="description" name="description" content="Update your profile" />
            </Head>

            <admin-navbar>
                <template #header>{{caretaker.name}}</template>
            </admin-navbar>
            <div class="pt-14">
                <div class="grid lg:grid-cols-4">
                    <div class="lg:col-span-1 p-5 grid border">
                        <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                            <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
                        </div>
                        <div class=" mt-5">
                            <h6 class="capitalize font-semibold">{{caretaker.name}} {{caretaker.last_name}}</h6>
                            <p>Email: <span class="text-sky-800">{{caretaker.email}}</span></p>
                            <p>Cellphone: <span class="text-sky-800">{{caretaker.cellphone}}</span></p>
                            <p>Status: <span class="text-sky-800" v-if="caretaker.status">Active</span>
                                <span class="text-sky-800" v-else>Disabled</span>
                            </p>
                            <p>Member Since: <span class="text-sky-800">{{(new Date(caretaker.created_at).toDateString())}}</span></p>
                            <p>caretaker Id: <span class="text-sky-800">{{caretaker.caretaker_id}}</span></p>

                        </div>
                    </div>
                    <div class="lg:col-span-3 grid">
                        <div class="border overflow-hidden">
                            <div class="border-b py-5 px-5 bg-sky-50">
                                <h1 class="font-semibold text-xl">Company Details</h1>
                            </div>
                            <div class="py-5 px-5">
                                <!-- Additional Data about caretaker-->


                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
        <template #sidebar>
            <resource-block>
                <template #links>

                    <link-btn :href="'/admin/users/caretakers/'+caretaker.id" class="text-sm" :class="[caretaker.status ? 'btn-danger' : 'btn-success']" method="patch" as="button">
                       <span v-if="caretaker.status">Disable</span>
                        <span v-else>Enable</span>
                    </link-btn>

                </template>
            </resource-block>
        </template>
    </admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import AdminNavbar from "@/views/components/admin-navbar.vue";
import Admin from "@/views/layouts/admin.vue";
import ResourceBlock from "@/views/components/resource-block.vue";
import LinkBtn from "@/views/components/link-btn.vue";

defineProps({
    caretaker:Object
})

</script>

<style scoped>

</style>

