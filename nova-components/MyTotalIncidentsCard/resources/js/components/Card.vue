<template>
    <card class="flex justify-center flex-col items-center">
        <div>
            <h1 class="font-bold text-xl text-80 font-light">My Total Incidents</h1>
            <h2 class="pt-6 text-center text-primary">{{total}}</h2>
        </div>
    </card>
</template>

<script>
export default {

    data() {
        return {
            total: this.card.total
        }
    },

    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
        //
    },
}
</script>