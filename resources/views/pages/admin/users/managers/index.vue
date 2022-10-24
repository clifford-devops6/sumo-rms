<template layout="admin">
    <Head>
        <title>Managers</title>
        <meta head-key="description" name="description" content="This is the default description" />

    </Head>
    <div>
        <admin-navbar>
            <template #header>
               Managers
            </template>
            <template #links>

            </template>
        </admin-navbar>
    </div>
    <div class="pt-14 pb-8">
        <div class="bg-sky-50 p-5 flex justify-between ">
            <p>
                <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                Managers are the top level organizations users. They can create company files and
                modify accounts
            </p>
        </div>


        <div class="border overflow-hidden">
            <!--table search and name-->
            <div class="flex justify-between px-3 py-3">
                <div>
                    <h6 class="font-bold">Managers ({{ managers.total}})</h6>

                </div>

                <div class=" mr-5">

                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input v-model="search" type="search" id="default-search"
                               class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600"
                               placeholder="Search roles..." required>

                    </div>
                </div>
            </div>

            <table class="table-auto w-full mt-3 border-t">
                <thead>
                <tr class="bg-gray-100 h-14 text-sky-800">
                    <th class="text-start py-3 px-4">Id</th>
                    <th class="text-start py-3 px-4">Name</th>
                    <th class="text-start py-3 px-4">Last Name</th>
                    <th class="text-start py-3 px-4">Email</th>
                    <th class="text-start py-3 px-4">Cellphone</th>
                    <th>Status</th>
                    <th class="text-end py-3 px-4">Action</th>


                </tr>
                </thead>
                <tbody>
                <tr class="border-b" v-if="managers.data" v-for="manager in managers.data" :key="manager.id">
                    <td class="py-3 px-4">{{ manager.id }}</td>
                    <td class="py-3 px-4">{{ manager.name }}</td>
                    <td class="py-3 px-4">{{ manager.last_name }}</td>
                    <td class="py-3 px-4">{{ manager.email}}</td>
                    <td class="py-3 px-4">{{ manager.cellphone}}</td>
                    <td class="py-3 px-4">
                        <span class="text-green-500" v-if="manager.status">Active</span>
                        <span class="text-red-900" v-else>Disabled</span>
                    </td>
                    <td class="py-3 px-4 text-end">
                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="cursor-pointer hover:text-sky-800"> Action <span class="ml-2"><i
                                class="fal fa-ellipsis-v-alt"></i></span></label>
                            <ul tabindex="0" class="dropdown-content   shadow-md bg-sky-50 rounded-md divide-y w-44">
                                <li class="text-start">
                                    <Link :href="'/admin/users/managers/'+ manager.id"
                                          method="get" as="button"
                                          class="font-semibold hover:text-sky-800 text-sm py-3 px-3">
                                        <span class="mr-1"><i class="fal fa-bookmark"></i></span>Details</Link>
                                </li>
                                <li class="text-start">
                                    <Link :href="'/admin/users/managers/'+ manager.id"
                                          method="patch" as="button"
                                          class="hover:text-sky-800 text-sm font-bold py-3 px-3" v-if="manager.status">
                                        <span class="mr-1"><i class="fal fa-user-slash"></i></span>
                                        Disable
                                    </Link>
                                    <Link :href="'/admin/users/managers/'+ manager.id"
                                          method="patch" as="button"
                                          class="hover:text-sky-800 text-sm font-bold py-3 px-3" v-else>
                                        <span class="mr-1"><i class="fal fa-user-check"></i></span>
                                        Enable
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </td>

                </tr>
                <tr v-if="managers.data==null">
                    <td colspan="4" class="py-3 px-4">
                        No roles found!
                    </td>
                </tr>


                </tbody>

            </table>
            <div class="bg-gray-100 p-3 flex justify-between">
                <div class="self-center">
                    <h6 class="font-medium">Showing <span class="text-sky-800">{{ managers.current_page }}</span> of
                        <span
                            class="text-sky-800">{{ managers.last_page }}</span> Page(s)</h6>
                </div>
                <div class="flex" >
                    <Link :href="managers.prev_page_url" class="btn-primary text-xs m-1"
                          v-if="managers.prev_page_url" ><span
                        class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                    </Link>
                    <Link :href="managers.next_page_url" class="btn-primary text-xs m-1" v-if="managers.next_page_url">
                        Next
                        <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                </div>

            </div>
        </div>

    </div>


</template>

<script setup lang="ts">

import {Head} from "@inertiajs/inertia-vue3";
import adminNavbar from "@/views/components/admin-navbar.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
let props=defineProps({
    managers:Object,
    filters:Object
})
//search
let search=ref(props.filters.search)
watch(search, _.debounce(function (value) {
    Inertia.get('/admin/users/managers',{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
</script>


