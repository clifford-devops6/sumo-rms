<template layout="admin">
    <Head>
        <title>Admin</title>
        <meta head-key="description" name="description" content="This is the default description" />

    </Head>
    <div>
      <admin-navbar>
          <template #header>
              Admin Panel
          </template>
          <template #links>

          </template>
      </admin-navbar>
    </div>
    <div class="pt-16 px-3">

        <div>
        <h2>Buttons</h2>
        <div class="inline-block mt-3">
            <button type="button" class="btn-success">Success</button>
            <button type="button" class="btn-outline-primary m-1">Primary Outline</button>
            <button type="button" class="btn-primary  m-1">Primary</button>
            <button type="button" class="btn-warning m-1">Warning</button>
            <button type="button" class="btn-danger  m-1">Danger</button>
            <button type="button" class="btn-secondary  m-1">Secondary</button>


        </div>
    </div>

    <div>


    </div>
    <div class="bg-white rounded-3xl shadow mt-8 overflow-hidden">
        <!--table search and name-->
        <div class="flex justify-between p-5">
          <h6 class="font-bold">Users Table</h6>
            <div class=" mr-5">
                <input type="search"
                       class="border rounded-full w-full h-10 bg-transparent
                          focus:outline-blue-800 p-2 w-72 text-sm"
                       placeholder="Search table...">
            </div>
        </div>

        <table class="table-auto w-full mt-3 border-t">
            <thead >
            <tr class="bg-gray-100 h-14 text-sky-800">
                <th class="text-start py-3 px-4">Id </th>
                <th class="text-start py-3 px-4">Name</th>
                <th class="text-start py-3 px-4">Email</th>
                <th class="text-start py-3 px-4">City</th>
                <th class="text-start py-3 px-4">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b dark:bg-gray-800">
                <td class="py-3 px-4">1</td>
                <td class="py-3 px-4">John Doe</td>
                <td class="py-3 px-4">johndoe@gmail.com</td>
                <td class="py-3 px-4">Nairobi</td>
                <td class="py-3 px-4">Action <span class="ml-2"><i class="fal fa-ellipsis-v-alt"></i></span></td>
            </tr>
            <tr class="border-b dark:bg-gray-800">
                <td class="py-3 px-4">2</td>
                <td class="py-3 px-4">Jane Doe</td>
                <td class="py-3 px-4">janedoe@gmail.com</td>
                <td class="py-3 px-4">Nairobi</td>
                <td class="py-3 px-4">Action <span class="ml-2"><i class="fal fa-ellipsis-v-alt"></i></span></td>
            </tr>
            <tr class="border-b dark:bg-gray-800">
                <td class="py-3 px-4">3</td>
                <td class="py-3 px-4">Kevin Malik</td>
                <td class="py-3 px-4">Kevinmalik@gmail.com</td>
                <td class="py-3 px-4">Nairobi</td>
                <td class="py-3 px-4">Action <span class="ml-2"><i class="fal fa-ellipsis-v-alt"></i></span></td>
            </tr>
            <tr class="border-b dark:bg-gray-800">
                <td class="py-3 px-4">4</td>
                <td class="py-3 px-4">Maria Wanderi</td>
                <td class="py-3 px-4">mariawanderi@gmail.com</td>
                <td class="py-3 px-4">Nairobi</td>
                <td class="py-3 px-4">Action <span class="ml-2"><i class="fal fa-ellipsis-v-alt"></i></span></td>

            </tr>
            </tbody>

        </table>
        <div class="bg-gray-100 p-3 flex justify-between">
            <div class="self-center">
                <h6 class="font-medium">Showing <span class="text-sky-800">3</span> of <span class="text-sky-800">16</span> Pages</h6>
            </div>
          <div class="flex">
              <button type="button" class="btn-primary text-xs m-1"><span class="mr-2"><i class="far fa-angle-left"></i></span>Prev</button>
              <button type="button" class="btn-primary text-xs m-1">Next <span class="ml-2"><i class="far fa-angle-right"></i></span></button>
          </div>

        </div>
    </div>

    <!--cards-->
    <div class="mt-8 flex grid grid-cols-3 gap-2">
        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <div class="border-b py-5 px-5">
                <h1 class="font-semibold text-xl">This will be the card title</h1>
            </div>
            <div class="py-5 px-5">
                <div>
                    <h6 class="font-semibold text-xl">Card title will be here</h6>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into
                        electronic typesetting, remaining essentially unchanged. It was popularised in
                        the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-3xl shadow overflow-hidden">
           <div>
              <img :src="'/images/card.jpg'" alt="Card Image"/>
           </div>
            <div class="py-5 px-5">
                <div>
                    <h6 class="font-semibold text-xl">Card title will be here</h6>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into
                        electronic typesetting, remaining essentially unchanged.git</p>
                </div>
            </div>
        </div>



    </div>
    <div class="mt-5">
        <h6>Form inputs customization</h6>
       <div class="mt-5">
           <label for="form-input" class="sumo-label">Sample Input:</label>
           <input type="text" class="sumo-input" id="form-input" placeholder="Sumo placeholder text"/>
       </div>
        <div class="mt-5">
            <label for="form-email" class="sumo-label">Sample Email:</label>
            <input type="email" class="sumo-input" id="form-email" placeholder="email@gmail.com"/>
            <div class="mt-3 text-red-800 text-sm">
                <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>Input Email is required. Sample error</span>
            </div>
        </div>
        <div class="mt-5">

            <label for="message" class="sumo-label">Your message</label>
            <textarea id="message" rows="4" class="sumo-input" placeholder="Leave a comment..."></textarea>

        </div>


        <div class="mt-5">
            <h1>Rich Text Editor</h1>
            <editor
                :init="{
           plugins: 'lists link image table code help wordcount',
            selector: 'textarea',  // change this value according to your HTML
            min_height: 400
          }"
            />
        </div>




    </div>
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/inertia-vue3'
import Editor from "@tinymce/tinymce-vue";
import {Dropdown} from "flowbite-vue";
import AdminNavbar from "@/views/components/admin-navbar.vue";

defineProps({
    user:Object,
})

</script>

