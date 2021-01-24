<template>
    <span class="text-red-500"><strong>{{ field.value }}</strong></span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
