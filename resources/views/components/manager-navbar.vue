<template>
    <div class="static relative z-50">
        <nav class="fixed top-0 left-0 right-0 border-b shadow-md py-3  bg-white flex pl-7 items-center mx-auto w-auto" >
            <div class="h-10 " style=" width: 200px;">
                <img src="/images/final-logo-outlines.png" class=" w-48 h-18 object-fit" alt="">
            </div>
            <div class="divider divider-horizontal"></div>
            <div class="ml-3 h-full flex flex-col title-container" style="width: 30%;">
                <div class="border-b-2 border-grey-400 flex justify-between text-center">
                    <p class="text-xl text-gray-400 tracking-normal font-medium">Fedha Plaza</p>
                    <p class="text-gray-600" style="font-size: 12px;">10 floors, 100 units</p>
                </div >
                <div class="flex justify-between pt-1">
                    <p class="text-gray-400 tracking-wide text-base font-medium">Knight Frank Property Management</p>
                <p class="text-gray-600" style="font-size: 12px;">Occupancy, 96%</p>
                </div>
            </div>
            <div>
                <div class="dropdown dropdown-end ">
                    <label tabindex="0" ><span class="pl-5 "><i class="fa fa-chevron-down fa-lg" aria-hidden="true"></i></span></label>
                    <ul tabindex="0" class="dropdown-content menu p-2  bg-gray-100 w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>
            </div>
            <div class="divider divider-horizontal"></div>
            <div class="flex flex-col text-center w-30">
                <a href="#">
                    <span><i class="fa fa-plus fa-1x pb-2" aria-hidden="true" style="color: #9D9D9D;"></i></span>
                    <p class="text-gray-500 tracking-wide">Add Property</p>
                </a>
            </div>
            <div class="divider divider-horizontal"></div>

            <div class="flex justify-evenly w-32 items-center content-center icon-container">
                <i class="fa fa-envelope fa-lg mx-4 " aria-hidden="true" style="color: #9D9D9D;"></i>
                <i class="fa fa-bell fa-lg mx-3" aria-hidden="true" style="color: #9D9D9D;"></i>
            </div>
            <div class="w-auto grow flex justify-end  user-title-container pr-3" >
                <div class="">
                    <img class="w-12 h-12 rounded-full mx-2" src="/images/user.png" alt="">
                </div>
                <div class="flex flex-col items-end content-end">
                    <p class="text-medium">George Martin <span class="text-gray-400 font-light">(Property Owner)</span></p>
                    <div class="dropdown dropdown-end ">
                    <label tabindex="0" ><span class="text-sm text-gray-400">Add / Switch Profile<i class="fa fa-chevron-down fa-sm ml-2" aria-hidden="true"></i></span></label>
                    <ul tabindex="0" class="dropdown-content menu p-2  bg-gray-200 w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>

                </div>
            </div>


        </nav>

    </div>
</template>

<script>
export default {
    name: "manager-navbar"
}
</script>

<style scoped>


</style>
