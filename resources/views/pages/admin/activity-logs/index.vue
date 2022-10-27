<template>
<admin>
    <Head><title>Activity Log</title></Head>
    <admin-navbar><template #header>Activity Logs</template></admin-navbar>
    <div class="border">
        <!--table search and name-->
        <div class="flex justify-between px-3 py-2">
            <div>
                <h6 class="font-bold">Activity Logs</h6>
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
                    <input v-model="sort.search"  type="search" id="default-search"
                           class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600"
                           placeholder="Search roles..." required>

                </div>
            </div>


        </div>
        <div class="px-3 py-2">
            <div class="self-center">
                <h6 class="text-sm">SORT BY:</h6>
            </div>
            <div class="flex gap-3 w-full">
                <div>
                    <select  v-model="sort.event" required class="block p-1 w-36 text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500">
                        <option disabled  selected value="">All Events</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>

                    </select>
                </div>
                <div class="self-center">
                    <h6>Date From:</h6>
                </div>
                <div>
                    <input v-model="sort.from" type="date" class="block p-1 w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500">
                </div>

                <div class="self-center">
                    <h6>To:</h6>
                </div>
                <div>
                    <input v-model="sort.to" type="date" :min="sort.from"
                           class="block p-1 w-full text-sm text-gray-900 bg-gray-50
                           rounded-md border border-gray-300 focus:ring-sky-500 focus:border-sky-500">
                </div>



            </div>
        </div>

        <table class="table-auto w-full border-t">
            <thead>
            <tr class="bg-gray-100 h-14 text-sky-800">
                <th class="text-start py-3 px-4">Id</th>
                <th class="text-start py-3 px-4">Description</th>
                <th class="text-start py-3 px-4">Event</th>
                <th class="text-start py-3 px-4">Causer</th>
                <th class="text-start py-3 px-4">Subject</th>
                <th class="text-start py-3 px-4">on</th>
                <th class="text-end py-3 px-4">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b" v-if="activities.data" v-for="activity in activities.data" :key="activity.id">
                <td class="py-3 px-4">{{activity.id }}</td>
                <td class="py-3 px-4">{{_.truncate(activity.description, {
                    'length': 35,
                    'separator': ' '
                })}}</td>
                <td class="py-3 px-4">{{ activity.event}}</td>
                <td class="py-3 px-4">{{ activity.causer}}</td>
                <td class="py-3 px-4">{{ activity.subject}}</td>
                <td class="py-3 px-4">
                   {{(new Date(activity.created_at).toDateString())}}
                </td>
                <td class="py-3 px-4 text-end">
                    <Link :href="'/admin/activity-logs/'+ activity.id" class="text-sky-600">Details</Link>
                </td>

            </tr>
            <tr v-else class="py-3 px-4"><td colspan="7">No logs found!</td></tr>



            </tbody>

        </table>
        <div class="bg-gray-100 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{ activities.current_page }}</span> of
                    <span
                        class="text-sky-800">{{ activities.last_page }}</span> Page(s)</h6>
            </div>
            <div class="flex" >
                <Link :href="activities.prev_page_url" class="btn-primary text-xs m-1"
                      v-if="activities.prev_page_url" ><span
                    class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                </Link>
                <Link :href="activities.next_page_url" class="btn-primary text-xs m-1" v-if="activities.next_page_url">
                    Next
                    <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>

    <template #sidebar>
        <h6 class="mt-5 font-medium">Logs by events</h6>

    </template>
</admin>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import AdminNavbar from "@/views/components/admin-navbar.vue";
import {Link} from "@inertiajs/inertia-vue3";
import {reactive, ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash";

let props=defineProps({
    activities:Object,
    filters:Object
})
let sort=reactive({
    search:props.filters.search,
    event:props.filters.event,
    from:props.filters.from,
    to:props.filters.to
})

watch(sort,_.debounce(()=>{
    Inertia.get('/admin/activity-logs',{
      search:sort.search, from:sort.from, to:sort.to, event:sort.event
    }, {preserveState:true, replace:true});
},300))

</script>

<style scoped>

</style>
