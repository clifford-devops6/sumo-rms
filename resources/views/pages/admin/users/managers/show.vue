
<template >
    <admin>
    <div class="relative">
        <Head>
            <title>{{manager.name}}</title>
            <meta head-key="description" name="description" content="Update your profile" />
        </Head>

        <admin-navbar>
            <template #header>{{manager.name}}</template>
        </admin-navbar>
        <div class="pt-14">
            <div class="grid lg:grid-cols-4">
                <div class="lg:col-span-1 p-5 grid border">
                    <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                        <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
                    </div>
                    <div class=" mt-5">
                        <h6 class="capitalize font-semibold">{{manager.name}} {{manager.last_name}}</h6>
                        <p>Email: <span class="text-sky-800">{{manager.email}}</span></p>
                        <p>Cellphone: <span class="text-sky-800">{{manager.cellphone}}</span></p>
                        <p>Status: <span class="text-sky-800" v-if="manager.status">Active</span>
                            <span class="text-sky-800" v-else>Disabled</span>
                        </p>
                        <p>Member Since: <span class="text-sky-800">{{(new Date(manager.created_at).toDateString())}}</span></p>
                        <p>Manager Id: <span class="text-sky-800">{{manager.manager_id}}</span></p>

                    </div>
                </div>
                <div class="lg:col-span-3 grid">
                    <div class="border overflow-hidden">
                        <div class="border-b py-5 px-5 bg-sky-50">
                            <h1 class="font-semibold text-xl">Company Details</h1>
                        </div>
                        <div class="py-5 px-5">
                            <h6 class="capitalize font-semibold">{{manager.company.name}}</h6>
                            <div class="flex gap-2 mt-5">
                                <div>
                                    <p>Cellphone: <span class="text-sky-800">{{manager.company.cellphone}}</span></p>
                                    <p>Created on: <span class="text-sky-800">{{(new Date(manager.company.created_at).toDateString())}}</span></p>
                                </div>
                                <div>
                                    <p>Contact Person: <span class="text-sky-800">{{manager.company.contact_person_name}}</span></p>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
        <template #sidebar>
           <resource-block>
            <template #header>Users</template>
               <template #links>
                   <admin-nav-link :href="'/admin/users/managers'">
                       <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Managers</p>
                   </admin-nav-link>
                   <admin-nav-link :href="'/admin/users/tenants'">
                       <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Tenant</p>
                   </admin-nav-link>
                   <admin-nav-link :href="'/admin/users/caretakers'">
                       <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Unit Managers</p>
                   </admin-nav-link>
                   <admin-nav-link :href="'/admin/users/landlords'">
                       <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Landlords</p>
                   </admin-nav-link>
                   <admin-nav-link :href="'/admin/users/staffs'">
                       <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Staffs</p>
                   </admin-nav-link>
               </template>
           </resource-block>
        </template>
    </admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import AdminNavbar from "@/views/components/admin-navbar.vue";
import Admin from "@/views/layouts/admin.vue";
import ResourceBlock from "@/views/components/resource-block.vue";
import AdminNavLink from "@/views/components/admin-nav-link.vue";

defineProps({
    manager:Object
})

</script>

<style scoped>

</style>

