<template>
    <teleport to="body">
    <Transition
        enter-from-class="opacity-0 scale-125"
        enter-to-class="opacity-100 scale-100"
        enter-active-class="transition duration-300"
        leave-active-class="transition duration-200"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-125"
    >
        <div v-if="show" class="inset-0 fixed bg-black bg-opacity-40 z-50 grid place-items-center p-5">
            <div class="bg-white lg:w-1/2 w-full rounded-xl">
                <header class="px-3 py-3">
                    <div class="flex justify-between">

                        <slot name="header">
                            <div class="font-medium text-sumo-300 text-lg">
                                <h6>Modal Header</h6>
                            </div>
                        </slot>
                        <div class="mr-3">
                            <div class="text-end">
                                <button type="button" @click="$emit('close')"><span class="text-sumo-300 text-lg"><i
                                    class="fal fa-times"></i></span></button>
                            </div>
                        </div>
                    </div>

                </header>
                <hr>
                <div class="p-3.5">
                    <slot>
                        Default body
                    </slot>
                </div>
                <hr>
                <footer class="p-3.5">
                   <slot name="footer">

                   </slot>
                </footer>
            </div>
        </div>
    </Transition>
    </teleport>
</template>

<script setup lang="ts">
const emits=defineEmits(['close'])
emits("close")
 defineProps({
     show:Boolean,
 })
</script>

<style scoped>

</style>
