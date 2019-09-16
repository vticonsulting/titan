<template>
    <div>
        <h1 class="text-30 fw-500 lh-42 d-block mt-8 mb-4">
            {{ lang.participant_registration.awesome_exclaim }}
            <br>
            {{ lang.participant_registration.thanks_for_student }}
        </h1>
        <h3 class="text-18 fw-200 lh-22 d-block mb-3">{{ lang.participant_registration.need_another }}</h3>
        <button
            class="btn btn-primary btn-round d-4lock w-200px mx-auto mb-3 btn-drop-shadow text-18"
            @click="$emit('school-search', $event.target.value)"
        >{{ lang.yes }}</button>
        <a
            href="/v3/dashboard"
            class="no-button btn btn-navy btn-round d-block w-200px mx-auto mb-3 btn-drop-shadow text-18 d-block"
        >{{ lang.no }}</a>
    </div>
</template>

<script>

export default {
    computed: {
        lang () {
            return this.$store.state.lang;
        }
    },
    mounted: function () {
        let confetti = this.$confetti;
        confetti.start({
            shape: 'rect'
        });

        setTimeout(function () {
            confetti.stop();
        }, 3000);
    }
};
</script>

<style scoped>
</style>
