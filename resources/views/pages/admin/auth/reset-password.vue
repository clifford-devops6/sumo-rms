<template layout>
    <Head>
        <title>Reset Password</title>
        <meta head-key="description" name="description" content="Password reset" />

    </Head>

    <div class="h-screen grid place-content-center">
        <div class="bg-white rounded-3xl shadow overflow-hidden w-96">
            <div class=" py-5 px-5 ">
                <h1 class="font-semibold text-xl text-center mt-5">Update Password</h1>

            </div>
            <div class="py-5 px-5">

                <form @submit.prevent="form.post('/admin/auth/update-password')">

                    <input type="hidden"  v-model="form.token" >
                    <div class="mt-3">
                        <label for="form-input" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-envelope"></i></span>Email:</label>
                        <input type="email" class="sumo-input" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                            <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.email }}</span>
                        </div>
                    </div>
                    <div class="mt-7">
                        <label for="password" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Password:</label>
                        <input type="password" class="sumo-input" id="password" placeholder="Enter your password" required v-model="form.password"/>
                        <div v-if="form.errors.password" class="mt-3 text-red-800 text-sm">
                            <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.password}}</span>
                        </div>
                    </div>
                    <div class="mt-7">
                        <label for="password_confirmation" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                        <input type="password" class="sumo-input" id="password_confirmation" placeholder="Enter your password" required v-model="form.password_confirmation"/>

                    </div>
                    <div class="flex mt-4 place-content-end">
                        <button type="submit" class="btn-primary  m-1">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
 import {useForm} from "@inertiajs/inertia-vue3";
 import {Head} from "@inertiajs/inertia-vue3";

let data =defineProps({
     request:Object,
     code: String ,
 })
 let form=useForm({
     email:data.request.email,
     password: '',
     password_confirmation: '',
     token:data.code
 })



 let submit=()=>{
     form.post('/admin/auth/update-password');
 }
</script>

