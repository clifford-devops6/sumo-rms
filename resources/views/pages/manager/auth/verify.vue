<template layout>
    <Head>
        <title>Verify Email</title>
    </Head>
    <div className="h-screen grid place-content-center">
        <div className="bg-white rounded-3xl shadow overflow-hidden w-96">
            <div className=" py-5 px-5">
                <div className="bg-sky-50 p-3 flex rounded-md">
                    <div className="mr-3">
                        <span className="text-sky-800"><i className="fas fa-info-circle"></i></span>
                    </div>
                    <div>
                        <p v-if="$page.props.status" className="text-sky-800 text-sm">{{ $page.props.status }}</p>
                    </div>

                </div>
                <p className="mt-4">Before proceeding, please check your email for a verification link. If you did not
                    receive the email</p>
            </div>
            <div className="py-3 px-5">
                <div className="flex mt-4 place-content-end">
                    <Link href="/manager/auth/resend-link"
                          method="post" as="button" class=" mt-8 btn-primary">
                        Resend Link
                    </Link>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/inertia-vue3";
import {Head} from "@inertiajs/inertia-vue3";

</script>



