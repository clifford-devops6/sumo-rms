<template>
    <resource-block>
        <template #header>Users</template>
        <template #links>
            <admin-nav-link href="/admin/users/admins">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Admins</p>
            </admin-nav-link>
            <admin-nav-link href="/admin/users/managers">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Managers</p>
            </admin-nav-link>
            <admin-nav-link href="/admin/users/tenants">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Tenant</p>
            </admin-nav-link>
            <admin-nav-link href="/admin/users/caretakers">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Unit caretakers</p>
            </admin-nav-link>
            <admin-nav-link href="/admin/users/landlords">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Landlords</p>
            </admin-nav-link>
            <admin-nav-link href="/admin/users/staffs">
                <p><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Staffs</p>
            </admin-nav-link>
        </template>
    </resource-block>
</template>

<script setup lang="ts">
import ResourceBlock from "@/views/components/resource-block.vue";
import AdminNavLink from "@/views/components/admin-nav-link.vue";
</script>

