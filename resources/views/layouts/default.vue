<script setup lang="ts">
// This is a persistent layout
// Include me with <template layout="default" />
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init()
</script>

<template>
	<slot />
</template>
