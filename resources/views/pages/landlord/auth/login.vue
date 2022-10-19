<template>
    <Head>
        <title>Login</title>
    </Head>
    <div class="h-screen grid lg:grid-cols-2">
        <!---Registration form-->
        <div class="lg:bg-white md:bg-white bg-gradient-to-b from-sky-50 to-sky-400  flex place-content-center w-full lg:col-span-1">
            <div class="self-center border p-8 rounded-xl bg-white shadow-xl w-96">
                <h6 class="font-bold text-lg text-center text-sky-800">Login here: Landlord</h6>

                <div class="mt-8">
                    <form @submit.prevent="form.post('/landlord/auth/authenticate')">

                        <div class="mt-7">
                            <label for="form-input" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-envelope"></i></span>Email:</label>
                            <input type="email" class="sumo-input" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                            <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                                <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.email }}</span>
                            </div>
                        </div>
                        <div class="mt-8">
                            <label for="password" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Password:</label>
                            <input type="password" class="sumo-input" id="password" placeholder="Enter your password" required v-model="form.password"/>
                            <div v-if="form.errors.password" class="mt-3 text-red-800 text-sm">
                                <span><span><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.password}}</span>
                            </div>
                        </div>

                        <div class="flex mt-4 place-content-end">
                            <button type="submit" class="btn-primary  m-1" :disabled="form.processing">Login</button>
                        </div>

                        <div class="flex mt-5 ">
                            <p class="font-medium text-center">
                                <Link href="/landlord/auth/forgot-password" title="Password Reset" class="hover:text-sky-800">Forgot password</Link> |
                                <Link href="/landlord/auth/register" title="Register" class="hover:text-sky-800">Register</Link>
                            </p>

                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="hidden lg:block lg:col-span-1">
            <img :src="'/images/landlord.jpg'" alt="Sample Property Image" class="h-screen w-auto object-cover">
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head, useForm} from "@inertiajs/inertia-vue3";
import {Link} from "@inertiajs/inertia-vue3";
let form=useForm({
    email:'',
    password:'',

})
</script>

