<template>
    <admin>
        <Head>
            <title>Tenants</title>
            <meta head-key="description" name="description" content="Tenant users" />
        </Head>
        <div>
            <admin-navbar>
                <template #header>
                   Tenants
                </template>
            </admin-navbar>
        </div>
        <div class="pb-8">
            <div class="bg-sky-50 p-5 flex justify-between ">
                <p>
                    <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    Tenant users are either added by landlords, Property Managers or Unit Managers
                </p>
            </div>

            <users-table
                title="Tenants"
                :users="tenants"
                :filters="tenants"
                link="/admin/users/tenants/"
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
    tenants:Object,
    filters:Object
})

</script>


