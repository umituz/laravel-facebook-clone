<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <Navbar/>
        <div class="flex overflow-y-hidden flex-1">
            <div class="w-1/3">Sidebar</div>
            <div class="overflow-x-hidden w-2/3">
                <router-view></router-view>
                <p v-for="i in 100">tester {{ i }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar";

    export default {
        name: "App",
        components: {
            Navbar
        }
    }
</script>

<style scoped>

</style>
