<script setup lang="ts">
import { InertiaProgress } from '@inertiajs/progress'
import Dropdown from "@/views/components/dropdown.vue";
import {MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
InertiaProgress.init()
import {Link} from "@inertiajs/inertia-vue3";
</script>

<template>
    <div class="bg-white drop-shadow p-2 w-full fixed">
        <div class="flex justify-between my-2">
            <div class="self-center flex ">
                <div class="border border-sky-800 flex place-content-center w-10 h-10
                hover:cursor-pointer rounded-md hover:bg-sky-800 text-sky-800 hover:text-white">
                    <span class="text-lg self-center"><i class="fas fa-bars"></i></span>
                </div>

                <h3 class="font-medium ml-5 self-center">SUMO RMS</h3>
            </div>


            <div class="flex">
                <div class="hidden lg:block mr-5">
                    <input type="search"
                           class="border rounded-full w-full h-10 bg-transparent
                          focus:outline-blue-800 p-2 w-72 text-sm"
                           placeholder="Search Sumo RMS...">
                </div>
                <Dropdown>
                    <template #default>
                        <div class="flex place-content-center font-medium rounded-fulltext-sm py-2 px-4 bg-sky-800
                        hover:bg-sky-600 text-white rounded-full w-10 h-10">
                            <span class="self-center"><i class="fal fa-user"></i></span>
                        </div>



                    </template>
                    <template #menu>
                        <div class="py-1 divide-y font-semibold ">
                            <MenuItem v-slot="{ active }" class="py-5 text-md hover:text-sky-500">
                                <Link href="/" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                    <span class="mr-3"><i class="fal fa-home"></i></span>Home</Link>
                            </MenuItem>
                            <MenuItem v-slot="{ active }" class="py-5 text-md hover:text-sky-500">
                                <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                    <span class="mr-3"><i class="fal fa-user"></i></span>Profile</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }"  class="py-5 text-md hover:text-sky-500">
                                <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                    <span class="mr-3"><i class="fal fa-cog"></i></span>Account Setting</a>
                            </MenuItem>

                            <MenuItem v-slot="{ active }"  class="py-5 text-md hover:text-sky-500">
                                <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                    <span class="mr-3"><i class="fal fa-lock"></i></span>Log Out</a>
                            </MenuItem>
                        </div>
                    </template>

                </Dropdown>

            </div>


        </div>
    </div>
    <div class="bg-gray-100 font-Open-sans grid lg:grid-cols-6 text-gray-800 pt-12">
        <div class="col-span-1 hidden lg:block">
            <aside class="w-64 " aria-label="Sidebar">
                <div class="overflow-y-auto py-4 px-3 h-screen flex flex-col">

                    <ul class="space-y-2 mt-5 fixed overflow-y-scroll h-96">

                        <li>
                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-sliders-h"></i></span>

                                </div>
                                <p class="text-slate-600">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-home"></i></span>

                                </div>
                                <p class="text-slate-600">Properties</p>
                            </a>
                        </li>
                        <li>

                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-house-user"></i></span>

                                </div>
                                <p class="text-slate-600">Property Managers</p>
                            </a>
                        </li>
                        <li>

                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-users"></i></span>

                                </div>
                                <p class="text-slate-600">Users</p>
                            </a>
                        </li>

                        <li>
                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-binoculars"></i></span>

                                </div>
                                <p class="text-slate-600">Inspections</p>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fal fa-hard-hat"></i></span>

                                </div>
                                <p class="text-slate-600">Work Orders</p>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-200">
                                <div
                                    class=" flex drop-shadow-md mr-2 h-10 w-10 items-center justify-center rounded-lg bg-white">
                                    <span class="text-sky-800"><i class="fas fa-question-circle"></i></span>

                                </div>
                                <p class="text-slate-600">Tickets & Support</p>
                            </a>
                        </li>


                    </ul>
                    <div class="bg-white rounded-md p-3 drop-shadow-md w-48 fixed bottom-1">
                        <a href="#"
                           class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                            <p class="text-slate-600"><span class="mr-3 text-sky-800"><i class="fal fa-user-headset"></i></span>Help &
                                Support</p>
                        </a>
                        <hr class="my-2">
                        <a href="#"
                           class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                            <p class="text-slate-600"><span class="mr-3 text-sky-800"><i class="fal fa-cog"></i></span>Settings</p>
                        </a>
                        <hr class="my-2">
                        <a href="#"
                           class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                            <p class="text-slate-600"><span class="mr-3 text-sky-800"><i class="fal fa-user"></i></span>Account</p>
                        </a>

                    </div>

                </div>

            </aside>
        </div>
        <div class="col-span-5 pt-8">
            <div class="p-3">
                <slot/>
            </div>
       </div>
    </div>

</template>
