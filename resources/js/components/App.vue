<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <Navbar/>
        <div class="flex overflow-y-hidden flex-1">
            <Sidebar/>
            <div class="overflow-x-hidden w-2/3">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar";
    import Sidebar from "./Sidebar";

    export default {
        name: "App",
        components: {
            Navbar, Sidebar
        },
        created() {
            this.$store.dispatch('setPageTitle', this.$route.meta.title);
        },
        mounted() {
            this.$store.dispatch('fetchAuthUser');
        },
        watch: {
            $route(to, from) {
                this.$store.dispatch('setPageTitle', to.meta.title);
            }
        }
    }
</script>

<style scoped>

</style>
