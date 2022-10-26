<template>
    <admin>
        <Head>
            <title>Admin</title>
            <meta head-key="description" name="description" content="Super Admin users" />
        </Head>
        <div>
            <admin-navbar><template #header>Super Admins</template></admin-navbar>
        </div>
        <div class="pb-8">
            <div class="bg-sky-50 p-5 flex justify-between ">
                <p>
                    <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    Super users in the application. Full control and access is provided to each Admin user
                </p>
            </div>

            <users-table
                title="Admins"
                :users="users"
                :filters="users"
                link="/admin/users/admins/"
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
    users:Object,
    filters:Object
})

</script>


