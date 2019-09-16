<template>
    <div>
        <h1 class="text-60">{{ lang.welcome }}</h1>
        <p class="text-18 pb-3 mw-250px mx-auto font-weight-light">{{ lang.landing_tagline }}</p>
        <p class="text-13">{{ lang.get_started }}</p>
        <p>
            <button
                dusk="parent-registration"
                class="btn btn-primary btn-round py-2 d-block mw-200px w-200px mx-auto mb-4 btn-drop-shadow text-15"
                @click="_set_user_type('parent')">{{ lang.im_a_parent }}</button>
            <button
                dusk="teacher-registration"
                class="btn btn-success btn-round py-2 d-block mw-200px w-200px mx-auto text-15 mb-4"
                @click="_set_user_type('teacher')">{{ lang.im_a_teacher }}</button>
            <a
                data-toggle="modal"
                data-target="#sponsorInstructionModal"
                href="#"
                class="pledge-a-student btn btn-white-outline btn-813-dk-grey-outline btn-round py-2 d-block mw-200px mx-auto text-15">{{ lang.im_a_sponsor }}</a>
        </p>
        <p class="text-12 gap-strike my-4 mw-200px mx-auto"><span class="strike"/><span>{{ lang.or }}</span><span class="strike"/></p>
        <p class="text-13"><a
            :href="login_url"
            class="btn btn-grey mt-2 py-2 btn-round d-block mw-200px mx-auto btn-drop-shadow text-15">{{ lang.login }}</a></p>
    </div>
</template>

<script>
export default {
    props: {
        login_url: {
            type: String,
            default: null
        }
    },
    computed: {
        lang () {
            return this.$store.state.lang;
        }
    },
    methods: {
        _set_user_type (type) {
            this.$store.commit('set_user_type', type);
            this.$emit('register');
        }
    }
};
</script>
