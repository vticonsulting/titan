<template>
    <div>
        <h1 class="mt-8 mb-15 text-29 fw-500">Enter Teacher Code</h1>
        <div class="registration-form-constraint d-block mx-auto">
            <p class="text-14 lh-22 fw-200">Haven't received your Teacher Code yet? Ask your Boosterthon representative!</p>
            <p class="text-invalid text-11">{{ teacher_code_response }}</p>
            <input
                v-model="$parent.teacher_registration_code"
                name="teacher_registration_code"
                class="form-control mb-3"
                type="text"
                placeholder="Enter Code">
            <p class="text-11">
                <input
                    id="agree"
                    v-model="$parent.agrees_terms"
                    name="agree"
                    class="form-check-input"
                    type="checkbox"
                    value="agree">
                <label
                    class="lh-21 mb-0"
                    for="agree">I agree to the terms of participation</label>
                <span class="d-block">
                    <a
                        class="text-gray-lightest"
                        href="/v3/terms"
                        target="_blank"><u>Print Terms</u></a>
                </span>
            </p>
            <button
                :disabled="!$parent.agrees_terms || submitting"
                class="btn btn-primary btn-round d-block w-200px mx-auto mb-3 btn-drop-shadow text-18"
                type="submit"
                @click="validate_teacher_code()">Next
                <i
                    v-if="submitting"
                    class="fa fa-spinner fa-spin"/>
            </button>
            <a
                href="/v3"
                class="btn btn-navy btn-round d-block w-200px mx-auto mb-3 btn-drop-shadow text-18 d-block">Cancel</a>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        login_url: {
            type: String,
            default: ''
        },
        lang: {
            type: Array,
            default: null
        }
    },
    data: function () {
        return {
            teacher_code_response: null,
            submitting: false
        };
    },
    methods: {
        validate_teacher_code: function () {
            this.submitting = true;
            axios.get('/v3/api/registration/validate_teacher_code/' + this.$parent.teacher_registration_code)
                .then((response) => {
                    this.submitting = false;
                    if (response) {
                        if (response.data.success) {
                            $('input[name="teacher_registration_code"]').removeClass('is-invalid');
                            this.$emit('teacher_registered');
                        } else {
                            this.teacher_code_response = response.data.message;
                            $('input[name="teacher_registration_code"]').addClass('is-invalid');
                        }
                    }
                });
        }
    }
};
</script>
