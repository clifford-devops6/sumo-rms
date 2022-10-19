<template layout>
    <Head>
        <title>Verify Email</title>
    </Head>
    <div class="h-screen grid place-content-center">
        <div class="bg-white rounded-3xl shadow overflow-hidden w-96">
            <div class=" py-5 px-5">
                <div class="bg-sky-50 p-3 flex rounded-md"  v-if="$page.props.status">
                    <div class="mr-3">
                        <span class="text-sky-800"><i class="fas fa-info-circle"></i></span>
                    </div>
                    <div >
                        <p class="text-sky-800 text-sm">{{$page.props.status}}</p>
                    </div>

                </div>
                <p class="mt-4">Before proceeding, please check your email for a verification link. If you did not receive the email</p>
            </div>
            <form>
                <div class="mt-7 px-5">
                    <label for="otp-code" class="sumo-label">OTP Code:</label>
                    <input type="text" class="sumo-input" id="otp-code" placeholder="Enter your OTP Code" required v-model="form.code"/>
                    <div v-if="form.errors.code" class="mt-3 text-red-800 text-sm">
                        <span><span class="mr-2"><i class="fal fa-exclamation-circle"></i></span>{{ form.errors.code}}</span>
                    </div>
                </div>
                <div class="py-5 px-3 flex justify-end gap-2">
                    <div>
                        <Link href="/admin/auth/resend-link"
                              method="post" as="button" class="btn-primary">
                            Resend OTP
                        </Link>

                    </div>
                    <div>
                        <button type="submit" class="btn-success">Verify</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</template>

<script setup lang="ts">
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";
let form=useForm({
    code:''
})

</script>



