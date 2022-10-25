<template>
    <div class="relative z-50">
        <nav class="static border-b py-4 pl-3 pr-3 bg-white flex flex-wrap justify-between items-center mx-auto">
            <div>
                <p class="font-semibold text-sky-800">Dashboard: <slot name="header"></slot></p>
            </div>
            <div>
                <slot name="links"></slot>

            </div>



        </nav>

    </div>
</template>

<script>
export default {
    name: "admin-navbar"
}
</script>

<style scoped>

</style>
