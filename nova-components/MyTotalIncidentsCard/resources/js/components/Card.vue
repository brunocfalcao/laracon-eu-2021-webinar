<template>
    <card class="flex items-center">
        <div class="pl-6 py-3 flex items-center">
            <div class="bg-green-500 w-16 h-16 flex items-center justify-center rounded-lg">
                <i class="text-2xl text-white fas fa-chalkboard-teacher"></i>
            </div>
            <div class="pl-8">
                <p class="text-2xl font-bold">{{card.total}} Incidents assigned to me</p>
            </div>

        </div>
    </card>
</template>

<script>
export default {
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
