<template>
<!--    items-center-->
    <div class="flex flex-col ">
        <div class="relative">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img class="object-cover w-full"
                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRGYYnvBcXFLzALx6yk4vnlbnyJeX_y_cgYuPqh969GAmqjrv-r&usqp=CAU"/>
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <img class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                        src="https://avatars1.githubusercontent.com/u/22079280?s=460&u=cf9d1b9add8c7aab49b340ccd260f282c816a9fa&v=4" alt="">
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Show",
        data: () => {
            return {
                user: null,
                posts: null,
                userLoading: true,
                postLoading: true
            }
        },
        mounted() {
            axios.get('/api/users/' + this.$route.params.userId)
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.log("Unable to fetch user : " + error);
                })
                .finally(() => {
                    this.userLoading = false;
                });

            axios.get('/api/users/' + this.$route.params.userId + '/posts')
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.log("Unable to fetch posts : " + error);
                })
                .finally(() => {
                    this.postLoading = false;
                });
        }
    }
</script>

<style scoped>

</style>
