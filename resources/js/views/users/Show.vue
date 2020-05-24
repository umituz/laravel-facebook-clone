<template>
    <div>
        <div class="w-100 h-64 overflow-hidden">
            <img class="object-cover w-full"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRGYYnvBcXFLzALx6yk4vnlbnyJeX_y_cgYuPqh969GAmqjrv-r&usqp=CAU" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Show",
        data: () => {
            return {
                user: null,
                loading: true
            }
        },
        mounted() {
            axios.get('/api/users/' + this.$route.params.userId)
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.log("Unable to fetch posts : " + error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
</script>

<style scoped>

</style>
