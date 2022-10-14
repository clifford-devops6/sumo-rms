<template layout="admin">
    <Head>
        <title>Permissions</title>

    </Head>

    <div>

    </div>
    <div class="flex mx-5 justify-between">
        <div>
            <h6 class="font-medium text-sky-800">Admin/Permissions</h6>
            <p>
                Deleting or editing the Permissions will significantly affect the application
            </p>
        </div>
        <div class="self-center">
            <!-- The button to open modal -->
            <label for="my-modal" class="btn-primary cursor-pointer">Create permissions</label>
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
                                <input type="text" class="sumo-input" id="role-name" placeholder="Enter role name" required v-model="form.name"/>
                                <div v-if="form.errors.name" class="mt-3 text-red-800 text-sm">
                                    <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.name }}</span>
                                </div>
                            </div>
                            <div class="mt-7">
                                <label for="permission-guard" class="sumo-label">Permission Guard:</label>
                                <input type="text" class="sumo-input" id="permission-guard" placeholder="Enter role guard" required v-model="form.guard_name"/>
                                <div v-if="form.errors.guard_name" class="mt-3 text-red-800 text-sm">
                                    <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.guard_name}}</span>
                                </div>
                            </div>
                        </form>
                        <div class="modal-action flex gap-2">

                            <button type="submit" class="btn-primary  m-1" form="permission-form">Create</button>

                        </div>
                    </div>
                </div>
            </Teleport>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow mt-8 overflow-hidden">
        <!--table search and name-->
        <div class="flex justify-between p-5">
            <h6 class="font-bold">Permissions ({{permissions.data.length}})</h6>
            <div class=" mr-5">
                <input type="search"
                       class="border rounded-full w-full h-10 bg-transparent
                          focus:outline-blue-800 p-2 px-3 w-72 text-sm"
                       placeholder="Search table..." v-model="search">
            </div>
        </div>

        <table class="table-auto w-full mt-3 border-t">
            <thead >
            <tr class="bg-gray-100 h-14 text-sky-800">
                <th class="text-start py-3 px-4">Id </th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Guard</th>
                <th class="text-end py-3 px-4">Action</th>


            </tr>
            </thead>
            <tbody>
            <tr class="border-b"  v-for="permission in permissions.data" :key="role.id">
                <td class="py-3 px-4">{{permission.id}}</td>
                <td class="py-3 px-4">{{permission.name}}</td>
                <td class="py-3 px-4">{{permission.guard_name}}</td>
                <td class="py-3 px-4 text-end">Action <span class="ml-2"><i class="fal fa-ellipsis-v-alt"></i></span></td>

            </tr>


            </tbody>

        </table>
        <div class="bg-gray-100 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">{{permissions.current_page}}</span> of <span class="text-sky-800">{{permissions.last_page}}</span> Page(s)</h6>
            </div>
            <div class="flex">
                <Link :href="permissions.prev_page_url" class="btn-primary text-xs m-1" v-if="permissions.prev_page_url"><span class="mr-2"><i class="far fa-angle-left"></i></span>Prev</Link>
                <Link :href="permissions.next_page_url" class="btn-primary text-xs m-1" v-if="permissions.next_page_url">Next <span class="ml-2"><i class="far fa-angle-right"></i></span></Link>

            </div>

        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import Swal from 'sweetalert2'
import {Inertia} from "@inertiajs/inertia";
import _ from "lodash"


let props=defineProps({
   permissions:Object,
    filters:Object

})
const modal=ref(false)
//search
let search=ref(props.filters.search)

watch(search, _.debounce(function (value) {
    Inertia.get('/admin/roles-and-permissions/roles',{
        search:value
    }, {preserveState:true, replace:true});
}, 300))

let form= useForm({
    name:'',
    guard_name:''
})
let submit=()=>{
    form.post('/admin/roles-and-permissions/roles',{
        onSuccess:()=>{
            form.reset()
            modal.value=false
            Swal.fire({
                position: 'top-end',
                text: 'Role Successfully created',
                showConfirmButton: false,
                timer: 3000,
                backdrop:false
            })
        }
    })



    //use watch
}
</script>


