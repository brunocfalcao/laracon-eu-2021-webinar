<template>
    <div>
        <heading class="mb-6">Universal Blade Tool</heading>

        <card class="">
            <div v-html="html"></div>
        </card>
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
            html: '<h1>Hi there!</h1>'
        }
    },

    mounted() {
        //
    },
}
</script>

<style>
/* Scoped Styles */
</style>
