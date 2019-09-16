<template>
    <div class="meter">
        <span
            :style="{ width: width + '%' }"
            :class="['meter-1', color == 'secondary' ? 'has-background-secondary': 'bg-primary' ]"
        />
    </div>
</template>
<script>
export default {
    name: 'ProgressMeter',
    status: 'prototype',
    release: '1.0.0',
    props: {
        width: {
            type: Number,
            default: 100
        },
        color: {
            type: String,
            default: 'primary'
        }
    }
};
</script>

<style lang="scss" scoped>
@import '../../../sass/_variables.scss';

.meter {
    height: 0.75rem;
    position: relative;
    background: $grey-lighter;
    border-radius: 25px;
}
.meter.is-small {
    height: 10px;
}
.meter.is-small > span {
    background-color: $secondary;
}

.meter > span {
    display: block;
    height: 100%;
    top: 0;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    position: absolute;
    overflow: hidden;
}
.meter > span.meter-1 {
    /* background-color: $primary; */
    z-index: 2;
}
.meter > span.meter-2 {
    background-color: $tertiary;
    z-index: 1;
}
</style>
