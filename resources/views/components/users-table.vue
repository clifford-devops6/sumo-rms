<template>
    <div class="border overflow-hidden">
        <!--table search and name-->
        <div class="flex justify-between px-3 py-3">
            <div>
                <h6 class="font-bold">{{title}} ({{ users.total}})</h6>

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
                <th class="text-start py-3 px-4">Status</th>
                <th class="text-end py-3 px-4">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="users.data" v-for="user in users.data" :key="user.id">
                <td class="py-3 px-4">{{ user.id }}</td>
                <td class="py-3 px-4">{{ user.name }}</td>
                <td class="py-3 px-4">{{ user.last_name }}</td>
                <td class="py-3 px-4">{{ user.email}}</td>
                <td class="py-3 px-4">{{ user.cellphone}}</td>
                <td class="py-3 px-4">
                    <span class="text-green-500" v-if="user.status">Active</span>
                    <span class="text-red-900" v-else>Disabled</span>
                </td>
                <td class="py-3 px-4 text-end">
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="cursor-pointer hover:text-sky-800"> Action <span class="ml-2"><i
                            class="fal fa-ellipsis-v-alt"></i></span></label>
                        <ul tabindex="0" class="dropdown-content   shadow-md bg-sky-50 rounded-md divide-y w-44">
                            <li class="text-start">
                                <Link :href="'/admin/users/users/'+ user.id"
                                      method="get" as="button"
                                      class="font-semibold hover:text-sky-800 text-sm py-3 px-3">
                                    <span class="mr-1"><i class="fal fa-bookmark"></i></span>Details</Link>
                            </li>
                            <li class="text-start">
                                <Link :href="'/admin/users/users/'+ user.id"
                                      method="patch" as="button"
                                      class="hover:text-sky-800 text-sm font-bold py-3 px-3" v-if="user.status">
                                    <span class="mr-1"><i class="fal fa-user-slash"></i></span>
                                    Disable
                                </Link>
                                <Link :href="'/admin/users/users/'+ user.id"
                                      method="patch" as="button"
                                      class="hover:text-sky-800 text-sm font-bold py-3 px-3" v-else>
                                    <span class="mr-1"><i class="fal fa-user-check"></i></span>
                                    Enable
                                </Link>
                            </li>
                            <li class="text-start">
                                <Link href="#"
                                      method="get" as="button"
                                      class="font-semibold hover:text-sky-800 text-sm py-3 px-3">
                                    <span class="mr-1"><i class="fal fa-lock-alt"></i></span>Permissions</Link>
                            </li>
                        </ul>
                    </div>
                </td>

            </tr>



            </tbody>

        </table>
        <div class="bg-gray-100 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ users.current_page }}</span> of
                    <span
                        class="text-sky-800">{{ users.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex" >
                <Link :href="users.prev_page_url" class="btn-primary text-xs m-1"
                      v-if="users.prev_page_url" ><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="users.next_page_url" class="btn-primary text-xs m-1" v-if="users.next_page_url">
                    Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
let props=defineProps({
    title:String,
    users:Object,
    filters:Object,
    link:String
})
//search
let search=ref(props.filters.search)
watch(search, _.debounce(function (value) {
    Inertia.get(props.link,{
        search:value
    }, {preserveState:true, replace:true});
}, 300))
</script>


