<template>
    <div class="program-header card bg-transparent shadow-none">
        <div class="px-8 lg:px-0 pt-4 pb-8 md:mx-auto md:max-w-xl">
            <div class="media">
                <div
                    v-if="!school_image_blank"
                    class="self-center media-left"
                >
                    <figure class="image is-64x64">
                        <img
                            :src="`https://${awsBucket}.s3.amazonaws.com/program_logos/${program.microsite.school_image_name}`"
                            :alt="program.microsite.school_image_name"
                            class="is-rounded"
                        >
                    </figure>
                </div>
                <div class="media-content self-center">
                    <h1 class="text-white">
                        {{ program.event_name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ProgramHeader',
    status: 'prototype',
    release: '1.0.0',
    props: {
        program: {
            type: Object,
            default: null
        }
    },
    data () {
        return {
            awsBucket: process.env.MIX_AWS_BUCKET
        };
    },
    computed: {
        school_image_blank () {
            return this.program.microsite.school_image_name === null ||
                this.program.microsite.school_image_name === '' ||
                this.program.microsite.school_image_name === undefined;
        }
    }
};
</script>
