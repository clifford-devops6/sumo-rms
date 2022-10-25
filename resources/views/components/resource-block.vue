<script setup lang="ts">

</script>

<template>
   <div class="px-2">
       <header>
           <h1 class="font-bold text-sky-800 mt-3"><slot name="header"></slot> </h1>
       </header>
       <div class="mt-3">
           <slot name="links"></slot>
       </div>
       <slot name="buttons">

       </slot>
   </div>
</template>
