<template>
    <div>
        <heading class="mb-6">Blade View</heading>

        <loading-card :loading="loading" class="flex items-center">
            <div class="px-6 py-6" v-html="html"></div>
        </loading-card>

    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'BladeView',
        }
    },
    mounted() {
        this.fetch()
    },
    data() {
        return {
            html: 'Hi there!',
            loading:false
        }
    },
    methods: {
        fetch() {
            this.loading = true;
            Nova.request()
                .get('/nova-vendor/blade-view/endpoint', null)
                .then(response => {
                    this.loading = false;
                    this.html = response.data;
                })
                .catch(({response}) => {
                    this.loading = false;
                })
        }
    }

}
</script>

<style>
/* Scoped Styles */
</style>
