<template layout="admin">
    <div class="relative">


        <Head>
            <title>Permission</title>

        </Head>
        <admin-navbar>
            <template #header>Permissions</template>

        </admin-navbar>
        <div class="pt-14">
            <div class="bg-sky-50 p-5 flex justify-between ">
                <p>
                    <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    Deleting or editing the Permissions will significantly affect the application
                </p>

            </div>



            <div class="border overflow-hidden">
                <!--table search and name-->
                <div class="flex justify-between px-3 py-3">
                    <div>
                        <h6 class="font-bold self-center">Permissions ({{ permissions.data.length }})</h6>
                        <div class="self-center mt-3">

                            <!-- The button to open modal permission create -->
                            <label for="my-modal" class="btn-primary cursor-pointer text-xs">Create permissions</label>

                        </div>
                    </div>

                    <div class=" mr-5">

                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input v-model="search" type="search" id="default-search" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600" placeholder="Search permissions..." required>

                        </div>
                    </div>
                </div>

                <table class="table-auto w-full mt-3 border-t">
                    <thead>
                    <tr class="bg-gray-100 h-14 text-sky-800">
                        <th class="text-start py-3 px-4">Id</th>
                        <th class="text-start py-3 px-4">Name</th>
                        <th class="text-start py-3 px-4">Guard</th>
                        <th class="text-end py-3 px-4">Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b" v-if="permissions.data" v-for="permission in permissions.data" :key="permission.id">
                        <td class="py-3 px-4">{{ permission.id }}</td>
                        <td class="py-3 px-4">{{ permission.name }}</td>
                        <td class="py-3 px-4">{{ permission.guard_name }}</td>
                        <td class="py-3 px-4 text-end">Action <span class="ml-2"><i
                            class="fal fa-ellipsis-v-alt"></i></span></td>

                    </tr>
                    <tr v-if="permissions.data==null">
                        <td colspan="4" class="py-3 px-4">
                            No roles found!
                        </td>
                    </tr>

                    </tbody>

                </table>
                <div class="bg-gray-100 p-3 flex justify-between">
                    <div class="self-center">
                        <h6 class="font-medium">Showing <span class="text-sky-800">{{ permissions.current_page }}</span> of <span
                            class="text-sky-800">{{ permissions.last_page }}</span> Page(s)</h6>
                    </div>
                    <div class="flex">
                        <Link :href="permissions.prev_page_url" class="btn-primary text-xs m-1" v-if="permissions.prev_page_url"><span
                            class="mr-2"><i class="far fa-angle-left"></i></span>Prev
                        </Link>
                        <Link :href="permissions.next_page_url" class="btn-primary text-xs m-1" v-if="permissions.next_page_url">Next
                            <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--- all modals-->
    <Teleport to="body">
        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="my-modal" class="modal-toggle" v-model="modal"/>
        <div class="modal">
            <div class="modal-box">
                <div class="flex justify-between">
                    <h3 class="font-bold text-lg text-sky-800">Create permission</h3>
                    <label for="my-modal" class="cursor-pointer text-sky-800 text-xl">
                        <span><i class="fal fa-times"></i></span>
                    </label>
                </div>

                <form @submit.prevent="submit" id="permission-form">
                    <div class="mt-3">
                        <label for="permission-name" class="sumo-label">Permission Name:</label>
                        <input type="text" class="sumo-input" id="permission-name" placeholder="Enter permission name"
                               required v-model="form.name"/>
                        <div v-if="form.errors.name" class="mt-3 text-red-800 text-sm">
                                        <span><span class="mr-2"><i
                                            class="fal fa-exclamation-circle"></i></span>{{ form.errors.name }}</span>
                        </div>
                    </div>
                    <div class="mt-7">
                        <label for="permission-guard" class="sumo-label">Permission Guard:</label>
                        <input type="text" class="sumo-input" id="permission-guard" placeholder="Enter permission guard"
                               required v-model="form.guard_name"/>
                        <div v-if="form.errors.guard_name" class="mt-3 text-red-800 text-sm">
                                        <span><span class="mr-2"><i
                                            class="fal fa-exclamation-circle"></i></span>{{ form.errors.guard_name }}</span>
                        </div>
                    </div>
                </form>
                <div class="modal-action flex gap-2">

                    <button type="submit" class="btn-primary  m-1" form="permission-form">Create</button>

                </div>
            </div>
        </div>
    </Teleport>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import Swal from 'sweetalert2'
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"
import AdminNavbar from "@/views/components/admin-navbar.vue";



let props=defineProps({
    permissions:Object,
    filters:Object

})
const modal=ref(false)
//search
let search=ref(props.filters.search)

watch(search, _.debounce(function (value) {
    Inertia.get('/admin/roles-and-permissions/permission',{
        search:value
    }, {preserveState:true, replace:true});
}, 300))

let form= useForm({
    name:'',
    guard_name:''
})
let submit=()=>{
    form.post('/admin/roles-and-permissions/permission',{
        onSuccess:()=>{
            form.reset()
            modal.value=false
            Swal.fire({
                position: 'top-end',
                text: 'Permission Successfully created',
                showConfirmButton: false,
                timer: 3000,
                backdrop:false
            })
        }
    })



    //use watch
}
</script>


