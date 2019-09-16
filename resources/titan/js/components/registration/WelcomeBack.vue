<template>
    <div>
        <h1 class="text-48 mw-200px mx-auto">{{ lang.welcome_back }}</h1>
        <p class="mt-12">
            <button
                class="btn btn-primary btn-round py-2 d-block mw-200px mx-auto mb-4 btn-drop-shadow text-15 w-200px"
                @click="_set_user_type('parent')">{{ lang.im_a_parent }}</button>
            <button
                class="btn btn-success btn-round py-2 d-block mw-200px mx-auto mb-4 text-15 w-200px"
                @click="_set_user_type('teacher')">{{ lang.im_a_teacher }}</button>
            <a
                data-toggle="modal"
                data-target="#sponsorInstructionModal"
                href="#"
                class="btn btn-white-outline btn-813-dk-grey-outline btn-round py-2 d-block mw-200px mx-auto text-15 w-200px">{{ lang.im_a_sponsor }}</a>

        </p>
    </div>
</template>

<script>
export default {
    computed: {
        lang () {
            return this.$store.state.lang;
        }
    },
    methods: {
        _set_user_type (val) {
            axios.get('/v3/api/validate-profile-complete')
                .then((response) => {
                    if (response.data.valid === true) {
                        this.$store.commit('set_user_type', val);
                        this.$emit('selection-made');
                    } else {
                        window.location.href = '/v3/tk-register-participant';
                    }
                });
        }
    }
};

</script>
