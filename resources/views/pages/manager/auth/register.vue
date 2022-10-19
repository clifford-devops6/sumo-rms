<template>
    <Head>
        <title>Register as Property Manager</title>
    </Head>
    <div class="h-screen grid lg:grid-cols-2">
        <!---Registration form-->
        <div class="lg:bg-white md:bg-white bg-gradient-to-b from-sky-50 to-sky-400  flex place-content-center w-full lg:col-span-1">
           <div class="self-center border p-8 rounded-xl bg-white shadow-xl ">
               <h6 class="font-bold text-lg text-center text-sky-800">Register: Property manager</h6>

               <div class="mt-8">
                   <form @submit.prevent="form.post('/manager/auth/create')">
                       <div class="grid grid-cols-2 gap-2">
                           <div class="mt-3">
                               <label for="first_name" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-user-circle"></i></span>First Name:</label>
                               <input type="text" class="sumo-input" id="first_name" placeholder="Enter your first name" required v-model="form.name"/>
                               <div v-if="form.errors.name" class="mt-3 text-red-800 text-sm">
                                   <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.name }}</span>
                               </div>
                           </div>
                           <div class="mt-3">
                               <label for="last_name" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-user-circle"></i></span>Last name:</label>
                               <input type="text" class="sumo-input" id="last_name" placeholder="Enter your last name" required v-model="form.last_name"/>
                               <div v-if="form.errors.last_name" class="mt-3 text-red-800 text-sm">
                                   <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.last_name }}</span>
                               </div>
                           </div>
                       </div>
                       <div class="mt-7">
                           <label for="form-input" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-envelope"></i></span>Email:</label>
                           <input type="email" class="sumo-input" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                           <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                               <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.email }}</span>
                           </div>
                       </div>
                       <div class="grid grid-cols-2 gap-2 mt-7">
                           <div class="mt-3">
                               <label for="password" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Password:</label>
                               <input type="password" class="sumo-input" id="password" placeholder="Enter your password" required v-model="form.password"/>
                               <div v-if="form.errors.password" class="mt-3 text-red-800 text-sm">
                                   <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.password}}</span>
                               </div>
                           </div>
                           <div class="mt-3">
                               <label for="password_confirmation" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                               <input type="password" class="sumo-input" id="password_confirmation" placeholder="Confirm your password" required v-model="form.password_confirmation"/>
                           </div>

                       </div>
                       <div class="mt-7">
                           <label for="form-cellphone" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-phone-office"></i></span>Phone Number:</label>
                           <input type="text" class="sumo-input" id="form-cellphone" placeholder="Enter your Cellphone" required v-model="form.cellphone"/>
                           <div v-if="form.errors.cellphone" class="mt-3 text-red-800 text-sm">
                               <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.cellphone }}</span>
                           </div>
                       </div>
                       <div class="flex mt-4 place-content-end">
                           <button type="submit" class="btn-primary  m-1" :disabled="form.processing">Register</button>
                       </div>
                   </form>
               </div>
           </div>

        </div>
        <div class="hidden lg:block lg:col-span-1">
            <img :src="'/images/property.jpg'" alt="Sample Property Image" class="h-screen w-auto object-cover">
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, useForm} from "@inertiajs/inertia-vue3";
let form=useForm({
    name:'',
    last_name:'',
    email:'',
    cellphone:'',
    password:'',
    password_confirmation:''
})
</script>

<style scoped>

</style>
