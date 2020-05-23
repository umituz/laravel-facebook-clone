<template>
    <div class="bg-white h-12 flex items-center px-4">
        <div class="w-1/3">
            <div class="flex">
                <router-link to="/">
                    <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M23 12.1c0-6.1-4.9-11-11-11S1 6 1 12.1c0 5.5 4 10.1 9.3 10.9v-7.7H7.5v-3.2h2.8V9.7c0-2.8 1.6-4.3 4.2-4.3 1.2 0 2.5.2 2.5.2v2.7h-1.4c-1.4 0-1.8.8-1.8 1.7v2.1h3.1l-.5 3.2h-2.6V23c5.2-.9 9.2-5.4 9.2-10.9z"
                            fill="#1877f2"/>
                    </svg>
                </router-link>
                <div class="ml-2 relative">
                    <div class="absolute text-gray-700">
                        <svg viewBox="0 0 24 24" class="fill-current w-5 h-5 mt-2 ml-2">
                            <path fill-rule="evenodd"
                                  d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input type="text" name="search" placeholder="Search Facebook"
                           class="rounded-full w-56 bg-gray-200 h-8 focus:outline-none focus:shadow-outline text-sm pl-8">
                </div>
            </div>
        </div>
        <div class="w-1/3"></div>
        <div class="w-1/3"></div>
    </div>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>

</style>
