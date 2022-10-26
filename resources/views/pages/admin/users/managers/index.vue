<template>
    <admin>
        <Head>
            <title>Managers</title>
            <meta head-key="description" name="description" content="This is the default description" />
        </Head>
        <div>
            <admin-navbar>
                <template #header>
                    Managers
                </template>
            </admin-navbar>
        </div>
        <div class="pb-8">
            <div class="bg-sky-50 p-5 flex justify-between ">
                <p>
                    <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    Managers are the top level organizations users. They can create company files and
                    modify accounts
                </p>
            </div>

            <users-table
                title="Managers"
                :users="managers"
                :filters="managers"
                link="/admin/users/managers/"
            >
            </users-table>

        </div>
        <template #sidebar>
            <user-sidebar></user-sidebar>
        </template>
    </admin>




</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import Admin from "@/views/layouts/admin.vue";
import UsersTable from "@/views/components/users-table.vue";
import UserSidebar from "@/views/components/admin/user-sidebar.vue";
import AdminNavbar from "@/views/components/admin-navbar.vue";
defineProps({
    managers:Object,
    filters:Object
})

</script>


