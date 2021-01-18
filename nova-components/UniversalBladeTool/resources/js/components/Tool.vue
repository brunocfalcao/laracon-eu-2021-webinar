<template>
    <div>
        <heading class="mb-6">Universal Blade Tool</heading>

        <loading-card :loading="loading" class="flex items-center">
            <div class="px-6 py-6" v-html="html"></div>
        </loading-card>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'UniversalBladeTool',
        }
    },
    data() {
        return {
            html: 'Hi there!',
            loading:false
        }
    },
    mounted() {
        this.fetch()
    },
    methods: {
        fetch() {
            this.loading = true;
            Nova.request()
                .get('/nova-vendor/universal-blade-tool/endpoint', null)
                .then(response => {
                    this.loading = false;
                    this.html = response.data;
                })
                .catch(({response}) => {
                    this.loading = false;
                })
        },
        payload() {
            return {
                params: {
                    cardClass: this.card.cardClass
                }
            };
        },
    },
}
</script>

<style>
/* Scoped Styles */
</style>
