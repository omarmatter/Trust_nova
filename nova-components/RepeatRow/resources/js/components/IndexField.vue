<template>
<!--    <span v-for="(value, index) in field.value"> {{value.price}}</span>-->
    <span>{{ field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
