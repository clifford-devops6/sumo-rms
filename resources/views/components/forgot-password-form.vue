<template layout>
    <div class="h-screen grid place-content-center">
        <div class="bg-white rounded-3xl shadow overflow-hidden w-96">
            <div class=" py-5 px-5 ">
                <h1 class="font-semibold text-xl text-center mt-5">Password Reset</h1>
            </div>
            <div class="py-5 px-5">
                <form @submit.prevent="submit">

                    <div class="mt-3">
                        <label for="form-input" class="sumo-label"><span class="mr-2 text-sky-800"><i class="fal fa-envelope"></i></span>Email:</label>
                        <input type="email" class="sumo-input" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="mt-3 text-red-800 text-sm">
                            <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.email }}</span>
                        </div>
                    </div>

                    <div class="flex mt-4 place-content-end">
                        <button type="submit" class="btn-primary  m-1">Send link</button>
                    </div>
                    <div v-if="$page.props.status" class="text-center text-green-800 font-medium mt-5">
                        <span>{{ $page.props.status }}</span>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    url:String
})
import {useForm} from "@inertiajs/inertia-vue3";
let form=useForm({
   email: '',

})
let submit=()=>{
    form.post(props.url);
}

</script>

<style scoped>

</style>
