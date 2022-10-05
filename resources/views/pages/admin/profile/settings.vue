<template layout="admin">
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-1 bg-white shadow p-5 grid rounded-xl">
            <div class="rounded-full border bg-sky-800 w-14 h-14 flex place-self-center place-content-center mt-5">
                <span class="self-center text-2xl text-white"><i class="fal fa-user"></i></span>
            </div>
            <div class="text-center mt-5">
                <h6 class="capitalize">{{$page.props.auth.name}} {{$page.props.auth.last_name}}</h6>
                <p>Role: <span class="text-sky-800">{{$page.props.auth.role}}</span></p>
                <p>Email: <span class="text-sky-800">{{$page.props.auth.email}}</span></p>
            </div>
        </div>

    </div>

</template>

<script setup lang="ts">

</script>

<style scoped>

</style>
