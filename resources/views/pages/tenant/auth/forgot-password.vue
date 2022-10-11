<template layout>
    <Head>
        <title>Reset Password</title>
    </Head>
    <forgot-password-form url="/tenant/auth/password-store">
    </forgot-password-form>
</template>

<script setup lang="ts">
import {Head} from "@inertiajs/inertia-vue3";
import ForgotPasswordForm from "@/views/components/forgot-password-form.vue";

</script>

