<template>
    <admin>
        <Head>
            <title>Landlords</title>
            <meta head-key="description" name="description" content="Super Admin users" />
        </Head>
        <div>
            <admin-navbar><template #header>Landlords</template></admin-navbar>
        </div>
        <div class="pb-8">
            <div class="bg-sky-50 p-5 flex justify-between ">
                <p>
                    <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    Can register and assign property manager. Can also be added by property manager
                </p>
            </div>

            <users-table
                title="Landlord"
                :users="landlords"
                :filters="landlords"
                link="/admin/users/landlords/"
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
   landlords:Object,
    filters:Object
})

</script>


