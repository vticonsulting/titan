<template>
    <div v-if="false"/>
</template>
<script>
export default {
    name: 'Loader',
    props: {
        user: {
            type: Object,
            default: null
        },
        s3_bucket: {
            type: String,
            default: ''
        },
        avatar_path: {
            type: String,
            default: ''
        },
        lang: {
            type: Object,
            default: null
        }
    },
    created () {
        this.$store.commit('SET_USER', this.user);
        this.$store.commit('setS3Bucket', this.s3_bucket);
        this.$store.commit('setAvatarPath', this.avatar_path);
        this.$store.commit('SET_LANG', this.lang);
    }

};
</script>
