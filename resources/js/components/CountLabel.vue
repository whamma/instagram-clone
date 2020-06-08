<template>
    <div class="pr-5">
        <strong>{{ count }}</strong> {{ label }}
    </div>
</template>

<script>
export default {
    name: 'count',

    props: ['label', 'count'],

    data() {
        return {
            count: 0,
        };
    },
};
</script>
