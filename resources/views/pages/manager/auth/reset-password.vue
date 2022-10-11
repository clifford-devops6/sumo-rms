<template layout>
    <Head>
        <title>Reset Password</title>
        <meta head-key="description" name="description" content="Password reset" />

    </Head>
    <reset-password-form
        url="/manager/auth/update-password"
        :code="code"
        :email="request.email"
    >

    </reset-password-form>
</template>

<script setup lang="ts">

import {Head} from "@inertiajs/inertia-vue3";
import ResetPasswordForm from "@/views/components/reset-password-form.vue";
const props=defineProps({
    code:String,
    request:Object,
    url: String
})


</script>

