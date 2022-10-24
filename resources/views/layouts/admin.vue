<script setup lang="ts">
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()
import {Link} from "@inertiajs/inertia-vue3";
</script>
<template>
    <div class="relative min-h-screen">
        <div class="flex gap-2">
            <div class="relative">
                <aside class="w-64 top-0">
                    <div class="fixed w-64">
                        <div class="mt-5 px-3">
                            <h1>SUMO REMS LOGO</h1>
                        </div>
                        <div class="px-3 w-full mt-12">
                            <div class="flex gap-3">
                                <div class="rounded-full h-12 w-12 overflow-hidden">
                                    <img :src="'/images/user.png'" title="User Icon">
                                </div>
                                <div class="self-center">
                                    <div class="flex justify-between gap-4">
                                        <div>

                                            <h6 class="capitalize font-semibold">{{$page.props.auth.name}} {{$page.props.auth.last_name}}</h6>
                                            <Link href="/admin/auth/logout"
                                                      method="post" as="button"
                                                      class="text-sky-800 text-sm font-bold">
                                                    <span class="mr-1"><i class="fal fa-lock"></i></span>
                                                    Log Out
                                                </Link>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--search-->
                            <div class="mt-8">
                                <form>
                                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" id="default-search" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-sky-600 focus:border-sky-600 dark:bg-gray-700 " placeholder="Search Sumo RMS..." required>

                                    </div>
                                </form>
                            </div>

                            <div class="mt-7">
                                <ul>
                                    <li>
                                        <Link href="/">
                                            <div class="hover:bg-gray-200 w-full rounded-md px-3 py-2">
                                                <p class="font-semibold text-lg"> <span class="mr-3 text-sky-800"><i class="far fa-home"></i></span>Home</p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link href="/admin/dashboard">
                                            <div class="hover:bg-gray-200 w-full rounded-md px-3 py-2">
                                                <p class="font-semibold text-lg"> <span class="mr-3 text-sky-800"><i class="fal fa-sliders-h"></i></span>Dashboard</p>
                                            </div>
                                        </Link>

                                    </li>
                                    <li>
                                        <Link href="/admin/profile/settings">
                                            <div class="hover:bg-gray-200 w-full rounded-md px-3 py-2">
                                                <p class="font-semibold text-lg"> <span class="mr-3 text-sky-800"><i class="fal fa-cog"></i></span>Account Settings</p>
                                            </div>
                                        </Link>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-8 mx-4">
                            <h5 class="font-semibold text-lg text-sky-800">Links</h5>
                            <ul>
                                <li>
                                    <Link href="/admin/users/managers">
                                        <div class="w-full rounded-md px-3 ">
                                            <p class="font-semibold hover:text-sky-800"><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Users</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/roles-and-permissions/roles">
                                        <div class="w-full rounded-md px-3 ">
                                            <p class="font-semibold hover:text-sky-800"><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Roles</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/admin/roles-and-permissions/permission">
                                        <div class="w-full rounded-md px-3 ">
                                            <p class="font-semibold hover:text-sky-800"><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Permissions</p>
                                        </div>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="#">
                                        <div class="w-full rounded-md px-3 ">
                                            <p class="font-semibold hover:text-sky-800"><span class="mr-2 text-sky-800"><i class="far fa-angle-right"></i></span>Properties</p>
                                        </div>
                                    </Link>
                                </li>
                            </ul>

                        </div>



                    </div>
                </aside>
            </div>

            <div class="bg-white border-l w-full min-h-screen">

                <div>
                    <slot/>
                </div>

            </div>
        </div>
    </div>


</template>




