<template>
    <div class="lg:border lg:rounded-lg lg:shadow lg:pt-3 lg:pb-6">
        <div class="text-center mb-4">
            <h1 class="font-semibold text-xl">Share Sponsor Pledge Page</h1>
            <h2>Every share can raise up to $50!</h2>
        </div>
        <div class="share-buttons flex justify-between content-center">
            <div class="w-1/4 flex-wrap text-center">
                <ShareButton
                    :participants="participants"
                    :special-urls="specialUrls"
                    :has-video="hasVideo"
                    type="facebook"
                />
            </div>

            <div class="w-1/4 flex-wrap text-center">
                <ShareButton type="email" />
            </div>

            <div class="w-1/4 flex-wrap text-center">
                <ShareButton type="sms" />
            </div>

            <div class="w-1/4 flex-wrap text-center">
                <ShareButton
                    :special-urls="specialUrls"
                    :has-video="hasVideo"
                    type="link"
                />
            </div>
        </div>
    </div>

</template>

<script>
import ShareButton from '../element/ShareButton';

export default {
    name: 'ShareButtons',
    status: 'prototype',
    release: '1.0.0',
    components: {
        ShareButton
    },
    props: {
        participants: {
            type: Array,
            default: () => []
        }
    },
    computed: {
        hasVideo () {
            return this.participants.reduce((result, participant) => {
                return result || participant.profile.image_name;
            }, false);
        },
        specialUrls () {
            return this.participants[0].special_urls;
        }
    }
};
</script>
