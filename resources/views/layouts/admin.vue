<script setup lang="ts">
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()
import {Link} from "@inertiajs/inertia-vue3";
</script>

<template>
    <!-- admin navbar-->
    <div class="navbar bg-white shadow fixed z-[1000]">
        <div class="flex-none ml-3 lg:hidden">
            <label for="my-drawer-2" class="text-xl text-sky-800 font-bold hover:cursor-pointer">
                <span><i class="fas fa-bars"></i></span>
            </label>
        </div>
        <div class="flex-1 ml-3">
            <h3 class="font-medium self-center">SUMO RMS | <span class="capitalize text-sky-800">{{$page.props.auth.name}}</span></h3>
        </div>
        <div class="flex-none gap-2">
            <div class="hidden lg:block">
                <input type="search"
                       class="border rounded-full  h-10 bg-transparent
                          focus:outline-sky-800 p-2 w-72 text-sm"
                       placeholder="Search Sumo RMS...">
            </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0">
                    <div class="flex place-content-center font-medium rounded-full text-sm py-2 px-4 bg-sky-800
                        hover:bg-sky-600 text-white rounded-full w-10 h-10">
                        <label tabindex="0" class="m-1"><span class="self-center"><i class="fal fa-user"></i></span></label>
                    </div>
                </label>
                <ul tabindex="0" class="absolute divide-y mt-3 shadow menu menu-compact dropdown-content bg-base-100 rounded w-52">
                    <li>
                        <Link href="/" class="py-4 hover:text-sky-800 font-semibold">
                            <span class="mr-1"><i class="fal fa-home"></i></span>Home
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/profile/settings" class="py-4 hover:text-sky-800 font-semibold">
                            <span class="mr-1"><i class="fal fa-user"></i></span>Profile
                        </Link>
                    </li>
                    <li>
                        <Link href="#" class="py-4 hover:text-sky-800 font-semibold">
                            <span class="mr-1"><i class="fal fa-cog"></i></span>Settings
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/auth/logout"
                              method="post" as="button"
                              class="w-full bg-sky-800 py-4 text-white hover:bg-sky-600">
                            <span class="mr-1"><i class="fal fa-lock"></i></span>
                            Log Out
                        </Link>
                    </li>
                </ul>

            </div>
        </div>
    </div>



    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <div class="mt-20">

                <div class="p-3">
                    <slot/>
                </div>
            </div>



        </div>
        <div class="drawer-side">
            <label for="my-drawer-2 " class="drawer-overlay">

            </label>
          <div class="relative w-64 pt-20 bg-white lg:bg-transparent">
              <label for="my-drawer-2" class="cursor-pointer fixed right-0 top-20 mr-2 lg:hidden">
                  <div class="flex place-content-center font-medium rounded-full text-sm bg-green-600
                        hover:bg-green-800 text-white  w-10 h-10">
                      <span class="self-center"><i class="far fa-times"></i></span>
                  </div>

              </label>
              <ul class="overflow-y-auto   h-96">
                  <!-- Sidebar content here -->
                  <li >
                     <div class="hover:bg-gray-200 px-3 py-2">
                         <Link href="/admin/dashboard"
                               class="flex items-center text-base font-normal text-slate-600">
                             <p class="text-sky-600 font-medium">
                                 <span class="text-sky-800 mr-2"><i class="fal fa-sliders-h"></i></span>
                                 Dashboard
                             </p>

                         </Link>
                     </div>
                  </li>
                  <li >
                      <div class="hover:bg-gray-200 px-3 py-2">
                          <p class="text-sky-600 font-medium"><span class="text-sky-800 mr-3"><i class="fal fa-lock"></i></span>Roles & Permission</p>
                      </div>
                      <div class="ml-6">
                          <ul>
                              <li>
                                  <Link href="/admin/roles-and-permissions/roles"
                                        class="flex justify-between   text-gray-900 pr-5">
                                      <p class="text-slate-600">Roles</p>
                                  </Link>
                              </li>
                              <li>
                                  <Link href="/admin/roles-and-permissions/permission"
                                        class="flex items-center  text-base font-normal text-gray-900">

                                      <p class="text-slate-600">Permissions</p>
                                  </Link>
                              </li>
                          </ul>
                      </div>

                  </li>

                  <li >
                      <div class="hover:bg-gray-200 px-3 py-2">
                          <p class="text-sky-600 font-medium"><span class="text-sky-800 mr-3"><i class="fal fa-lock"></i></span>Roles & Permission</p>
                      </div>
                      <div class="ml-6">
                          <ul>
                              <li>
                                  <Link href="/admin/roles-and-permissions/roles"
                                        class="flex justify-between   text-gray-900 pr-5">
                                      <p class="text-slate-600">Roles</p>
                                  </Link>
                              </li>
                              <li>
                                  <Link href="/admin/roles-and-permissions/permissions"
                                        class="flex items-center  text-base font-normal text-gray-900">

                                      <p class="text-slate-600">Permissions</p>
                                  </Link>
                              </li>
                          </ul>
                      </div>

                  </li>



              </ul>
          </div>

        </div>
    </div>
</template>


