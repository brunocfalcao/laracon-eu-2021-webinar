<template>
    <loading-card :loading="loading" class="flex items-center">
       <div class="pl-6 py-3 flex items-center">
           <div class="bg-red-500 w-16 h-16 flex items-center justify-center rounded-lg">
               <i class="text-2xl text-white fas fa-chalkboard-teacher"></i>
           </div>
           <div class="pl-8">
               <p class="text-2xl font-bold">{{total}} Incidents Total</p>
           </div>
       </div>
    </loading-card>
</template>

<script>
export default {

    data: function() {
            return {
                loading: true,
                total: null
            }
        },

    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    methods: {
        fetch() {
            this.loading = true;
            Nova.request()
                .get('/nova-vendor/my-incidents-card/endpoint', null)
                .then(response => {
                    this.loading = false;
                    this.total = response.data.total;
                })
                .catch(({response}) => {
                    this.loading = false;
                })
        },
    },

    mounted() {
        this.fetch()
    },
}
</script>
