<template layout="admin">
    <Head>
        <title>Update your Profile</title>
        <meta head-key="description" name="description" content="Update your profile" />
    </Head>
    <div class="grid lg:grid-cols-4 gap-3">
        <div class="lg:col-span-1 bg-white shadow p-5 grid rounded-xl">
            <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
            </div>
            <div class="text-center mt-5">
                <h6 class="capitalize">{{$page.props.auth.name}} {{$page.props.auth.last_name}}</h6>
                <p>Role: <span class="text-sky-800">{{$page.props.auth.role}}</span></p>
                <p>Email: <span class="text-sky-800">{{$page.props.auth.email}}</span></p>

            </div>
        </div>
        <div class="lg:col-span-3 grid">
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="border-b py-5 px-5">
                    <h1 class="font-semibold text-xl">Personal Details</h1>
                </div>
                <div class="py-5 px-5">
                    <div class="py-3">
                        <h6><span class="text-sky-800 mr-3">Email:</span>{{user.email}}</h6>
                    </div>
                    <form @submit.prevent="form.patch('/admin/profile/settings/'+ user.id)">
                        <div class="grid lg:grid-cols-2 gap-3">
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
                        <div class="flex mt-5 place-content-end">
                            <button class="btn-primary disabled:cursor-not-allowed disabled:bg-gray-400 disabled:border-gray-400" :disabled="!form.isDirty">Update</button>

                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden mt-5">
                <div class="border-b py-5 px-5">
                    <h1 class="font-semibold text-xl">Update Password</h1>
                </div>
                <div class="py-5 px-5">

                    <form @submit.prevent="pass.patch('/admin/profile/password/'+ user.id)">
                        <div class="grid lg:grid-cols-2 gap-3">
                            <div class="mt-3">
                                <label for="password" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Password:</label>
                                <input type="password" class="sumo-input" id="password" placeholder="Enter your password" required v-model="pass.password" />
                                <div v-if="pass.errors.password" class="mt-3 text-red-password800 text-sm">
                                    <span><span><i class="fal fa-exclamation-circle"></i></span>{{ pass.errors.password }}</span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="confirm_password" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-lock"></i></span>Confirm Password:</label>
                                <input type="password" class="sumo-input" id="confirm_password" placeholder="Confirm your password" required v-model="pass.password_confirmation" />

                            </div>
                        </div>
                        <div class="flex mt-5 place-content-end">
                            <button class="btn-primary disabled:cursor-not-allowed disabled:bg-gray-400 disabled:border-gray-400" :disabled="!pass.isDirty">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";


const props= defineProps({
    user:Object,
});
let form=useForm(props.user);
let pass=useForm({
    password:'',
    password_confirmation:'',
})




</script>

