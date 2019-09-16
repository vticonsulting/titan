<template>
    <div class="share-button flex flex-col">
        <button
            :class="['is-rounded has-text-white w-12 h-12 rounded-full mx-auto cursor-pointer', config.className]"
            :data-tooltip="config.tooltipText"
            :title="config.tooltipText"
            @click="clicked">
            <FontAwesomeIcon
                :icon="config.icon"
                size="2x"
            />
        </button>
        <span class="text-sm">
            {{ config.label }}
        </span>
    </div>
</template>

<script>
import ClipboardJS from 'clipboard';
require('bootstrap');
export default {
    name: 'ShareButton',
    status: 'prototype',
    release: '1.0.0',
    props: {
        type: {
            type: String,
            default: 'facebook'
        },
        participants: {
            type: Array,
            default: () => []
        },
        specialUrls: {
            type: Array,
            default: () => []
        },
        hasVideo: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        config () {
            switch (this.type) {
            case 'email':
                return {
                    icon: 'envelope',
                    label: 'Email',
                    className: 'has-background-email'
                };
            case 'sms':
                return {
                    icon: 'comment',
                    label: 'Text Message',
                    className: 'has-background-text-message'
                };
            case 'link':
                return {
                    icon: 'link',
                    label: 'Copy Link',
                    className: 'has-background-copy-link copy-text',
                    tooltipText: 'Copied!'
                };
            case 'facebook':
            default:
                return {
                    icon: ['fab', 'facebook-f'],
                    label: 'Facebook',
                    className: 'has-background-facebook'
                };
            }
        }
    },
    methods: {
        clicked (event) {
            switch (this.type) {
            case 'email':
                console.log('i got clicked: ' + this.type);
                break;
            case 'sms':
                console.log('ii got clicked: ' + this.type);
                break;
            case 'link':
                this.shareLink();
                break;
            case 'facebook':
            default:
                this.shareFacebook();
            }
        },
        getShareUrl (referrerName) {
            let filterFunction = function (specialUrl) {
                return specialUrl.referrer.name === referrerName;
            };
            let shortKey = this.specialUrls.filter(filterFunction)[0].short_key;
            return window.location.protocol + '//' + window.location.hostname + '/a/s/' + shortKey;
        },
        shareLink () {
            let referrerName = this.hasVideo ? 'Link_Video' : 'Link';
            var clipboardjs = new ClipboardJS('.copy-text', {
                text: (trigger) => {
                    return this.getShareUrl(referrerName);
                }
            });
            clipboardjs.on('success', function (e) {
                $('.copy-text').tooltip({ trigger: 'manual' });
                $(e.trigger).tooltip('show');
                setTimeout(function () {
                    $(e.trigger).tooltip('hide');
                }, 1000);
            });
        },
        shareFacebook () {
            let referrerName = this.hasVideo ? 'Facebook_Video' : 'Facebook';
            let url = this.getShareUrl(referrerName);
            let participantUserId = this.participants[0].id;
            FB.ui(
                {
                    method: 'share',
                    href: url
                },
                function (response) {
                    if (response && !response.error_message) {
                        axios.get('/users/user_successful_facebook_share/' + participantUserId)
                            .catch(console.log);
                        var label = this.hasVideo ? 'Pledge Success Page Video' : 'Pledge Success Page';
                        ga('send', 'event', 'Share Public Pledge Page', 'Click Facebook Share', label, 1);
                    }
                }
            );
        }
    }
};
</script>

<style scoped>
</style>
