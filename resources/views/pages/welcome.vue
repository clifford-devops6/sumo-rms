<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
</script>
<template>
    <div class="grid h-screen place-items-center">
        <div class="">
            <h1 class="text-3xl flex justify-center">SUMO RMS</h1>
            <div class="flex mt-5">
                <ul class="flex gap-5">
                    <li class="text-sky-800 font-semibold hover:underline">
                        <Link href="/">Unit Manager</Link>
                    </li>
                    <li class="text-sky-800 font-semibold hover:underline">
                        <Link href="/admin/dashboard">Admin</Link>
                    </li>
                    <li class="text-sky-800 font-semibold hover:underline">
                        <Link href="#">Tenant</Link>
                    </li>
                    <li class="text-sky-800 font-semibold hover:underline">
                        <Link href="#">Property Owner</Link>
                    </li>
                    <li class="text-sky-800 font-semibold hover:underline">
                        <Link href="/manager/home" title="Manager">Manager</Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
