
<template >
    <admin>
        <div class="relative">
            <Head>
                <title>{{tenant.name}}</title>
                <meta head-key="description" name="description" content="Update your profile" />
            </Head>

            <admin-navbar>
                <template #header>{{tenant.name}}</template>
            </admin-navbar>
            <div class="pt-14">
                <div class="grid lg:grid-cols-4">
                    <div class="lg:col-span-1 p-5 grid border">
                        <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                            <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
                        </div>
                        <div class=" mt-5">
                            <h6 class="capitalize font-semibold">{{tenant.name}} {{tenant.last_name}}</h6>
                            <p>Tenant Type: <span class="text-sky-800">{{tenant.type.name}}</span></p>
                            <p>Email: <span class="text-sky-800">{{tenant.email}}</span></p>
                            <p>Cellphone: <span class="text-sky-800">{{tenant.cellphone}}</span></p>
                            <p>Cellphone 2: <span class="text-sky-800">{{tenant.secondary_cellphone}}</span></p>
                            <p>Status: <span class="text-sky-800" v-if="tenant.status">Active</span>
                                <span class="text-sky-800" v-else>Disabled</span>
                            </p>
                            <p>Member Since: <span class="text-sky-800">{{(new Date(tenant.created_at).toDateString())}}</span></p>
                            <p>tenant Id: <span class="text-sky-800">{{tenant.tenant_id}}</span></p>

                        </div>
                    </div>
                    <div class="lg:col-span-3 grid">
                        <div class="border overflow-hidden">
                            <div class="border-b py-5 px-5 bg-sky-50">
                                <h1 class="font-semibold text-xl">Next of Kin</h1>
                            </div>
                            <div class="py-5 px-5">
                                <!-- Additional Data about tenant-->


                            </div>
                        </div>

                        <div class="border overflow-hidden">
                            <div class="border-b py-5 px-5 bg-sky-50">
                                <h1 class="font-semibold text-xl">Lease details</h1>
                            </div>
                            <div class="py-5 px-5">
                                <!-- Additional Data about tenant-->


                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>
        <template #sidebar>
            <resource-block>
                <template #links>

                    <link-btn :href="'/admin/users/tenants/'+tenant.id" class="text-sm" :class="[tenant.status ? 'btn-danger' : 'btn-success']" method="patch" as="button">
                        <span v-if="tenant.status">Disable</span>
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
    tenant:Object
})

</script>

<style scoped>

</style>

