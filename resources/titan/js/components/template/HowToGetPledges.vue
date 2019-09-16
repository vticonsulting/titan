<template>
    <div class="how-to-get-pledges card-content">
        <div class="">
            <div class="p-4">
                <figure class="image is-16by9 mb-4">
                    <VideoIframe video-id="277705371"/>
                </figure>
            </div>

            <h4 class="font-bold text-lg text-center md:text-left mb-4">
                Asking for pledges is quick and easy with our sharing tools.
            </h4>
            <ul class="list-reset text-sm md:text-xl">
                <li class="flex items-center">
                    <a
                        href="#"
                        class="m-4"
                    >
                        <FontAwesomeIcon
                            icon="envelope"
                            size="2x"
                            fixed-width
                        />
                    </a>
                    <p>
                        <a
                            href="#"
                            class="font-semibold underline"
                        >
                            Add Email Addresses
                        </a> for friends and family to our
                        Easy-Emailer and let us do the rest!
                    </p>
                </li>
                <li class="flex items-center">
                    <a
                        href="#"
                        class="m-4"
                    >
                        <FontAwesomeIcon
                            :icon="['fab', 'facebook-f']"
                            size="2x"
                            fixed-width
                        />
                    </a>
                    <p>
                        <a
                            href="#"
                            class="font-semibold underline"
                        >
                            Share on Facebook
                        </a> and get pledges from sponsors
                        you never knew wanted to give!
                    </p>
                </li>
                <li class="flex items-center">
                    <a
                        href="#"
                        class="m-4"
                    >
                        <FontAwesomeIcon
                            icon="share-square"
                            size="2x"
                            fixed-width
                        />
                    </a>
                    <p>
                        <a
                            href="#"
                            class="font-semibold underline"
                            @click.prevent="scrollTo()"
                        >
                            Share the Student Star Video
                        </a> by customizing it
                        with your student's picture!
                    </p>
                </li>
                <li class="flex items-center">
                    <a
                        href="#"
                        class="m-4"
                    >
                        <FontAwesomeIcon
                            icon="mobile-alt"
                            size="2x"
                            fixed-width
                        />
                    </a>
                    <p>
                        <a
                            href="#"
                            class="font-semibold underline"
                        >
                            Use our Phone Script
                        </a> to call close friends and
                        family members and know exactly what to say!
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HowToGetPledges',
    status: 'prototype',
    release: '1.0.0',
    props: {
        program: {
            type: Object,
            default: null
        }
    },
    methods: {
        isDesktop () {
            return window.matchMedia('(min-width: 769px)').matches;
        },
        scrollTo () {
            this.$parent.$parent.$children[3].isOpen = true;

            setTimeout(() => {
                // scroll to top
                $('html, body').animate({
                    scrollTop: $(this.$parent.$parent.$children[3].$el).offset().top
                }, 300);
            }, 310);
        }
    }
};
</script>
