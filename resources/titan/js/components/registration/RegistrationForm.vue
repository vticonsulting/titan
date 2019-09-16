<template>
    <div>
        <div class="registration-form-constraint d-block mx-auto">
            <h2 class="mt-4">{{ lang.sign_up }}</h2>
            <form @submit="_verify($event)">
                <input
                    :value="csrf"
                    type="hidden"
                    name="_token" >
                <input
                    v-model="$parent.teacher_registration_code"
                    name="teacher_registration_code"
                    class="form-control mb-3"
                    type="hidden">
                <div class="form-group mx-auto">
                    <label class="sr-only">{{ lang.first_name }}</label>
                    <input
                        :class="[errors.first_name != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.first_name"
                        v-model="first_name"
                        type="text"
                        name="first_name"
                        required>
                    <div
                        v-if="errors.first_name != undefined"
                        class="error-msg">
                        {{ errors.first_name[0] }}
                    </div>
                </div>
                <div class="form-group  mx-auto">
                    <label class="sr-only">{{ lang.last_name }}</label>
                    <input
                        :class="[errors.last_name != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.last_name"
                        v-model="last_name"
                        type="text"
                        name="last_name"
                        required>
                    <div
                        v-if="errors.last_name != undefined"
                        class="error-msg">
                        {{ errors.last_name[0] }}
                    </div>
                </div>
                <div
                    v-if="!isSocialRegistration"
                    class="form-group mx-auto">
                    <label class="sr-only">{{ lang.email }}</label>
                    <input
                        :class="[errors.email != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.email"
                        v-model="email"
                        type="email"
                        name="email"
                        required
                        @change="_validateEmail">
                    <div
                        v-if="email_registered"
                        id="email-registered-error"
                        class="error-msg text-center p-3">
                        {{ lang.email_registered }}
                    </div>
                    <a
                        v-if="email_registered"
                        class="btn btn-primary btn-round d-block w-200px mx-auto mb-3 btn-drop-shadow text-18 text-white"
                        href="/v3/password/reset"
                    >{{ lang.reset_password }}</a>
                    <div
                        v-if="errors.email != undefined"
                        class="error-msg">
                        {{ errors.email[0] }}
                    </div>
                </div>
                <div
                    v-if="!email_registered && !isSocialRegistration"
                    class="form-group mx-auto">
                    <label class="sr-only">{{ lang.confirm_email }}</label>
                    <input
                        :class="[errors.email_confirmation != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.confirm_email"
                        v-model="email_confirmation"
                        type="email"
                        name="email_confirmation"
                        required>
                    <div
                        v-if="errors.email_confirmation != undefined"
                        class="error-msg">
                        {{ errors.email_confirmation[0] }}
                    </div>
                </div>
                <div
                    v-if="!email_registered && !isSocialRegistration"
                    class="form-group mx-auto">
                    <p class="mx-auto text-14 text-left fw-200 mb-2">{{ lang.password_requirements }}</p>
                    <label class="sr-only">{{ lang.password }}</label>
                    <input
                        :class="[errors.password != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.password"
                        v-model="password"
                        type="password"
                        name="password"
                        pattern=".{7,20}"
                        required>
                    <div
                        v-if="errors.password != undefined"
                        class="error-msg">
                        {{ errors.password [0] }}
                    </div>
                </div>
                <div
                    v-if="!email_registered"
                    class="form-group position-relative">
                    <label class="sr-only">{{ lang.phone }}</label>
                    <the-mask
                        :class="[errors.phone != undefined ? 'is-invalid' : '', 'form-control text-16']"
                        :placeholder="lang.phone_number"
                        v-model="phone"
                        type="tel"
                        name="phone"
                        maxlength="14"
                        mask="(###) ###-####"
                        required
                    />
                    <i
                        :title="lang.phone_tip"
                        class="fas fa-info-circle phone-tip"
                        data-toggle="tooltip"
                        data-placement="top"/>
                    <div
                        v-if="errors.phone != undefined"
                        class="error-msg">
                        {{ errors.phone [0] }}
                    </div>
                </div>
                <p
                    v-if="!email_registered"
                    class="mx-auto text-14 text-left fw-200 mb-2">{{ lang.birthdate }}</p>
                <div
                    v-if="!email_registered"
                    class="form-group d-flex justify-content-center mx-auto mb-2 positon-relative">
                    <select
                        :class="[errors.month != undefined ? 'is-invalid' : '', 'form-control']"
                        v-model="month"
                        name="month"
                        required>
                        <option
                            class="p-0"
                            value="-1"
                            disabled>{{ lang.month }}</option>
                        <option
                            class="p-0"
                            value="0">{{ lang.Jan }}</option>
                        <option
                            class="p-0"
                            value="1">{{ lang.Feb }}</option>
                        <option
                            class="p-0"
                            value="2">{{ lang.Mar }}</option>
                        <option
                            class="p-0"
                            value="3">{{ lang.Apr }}</option>
                        <option
                            class="p-0"
                            value="4">{{ lang.May }}</option>
                        <option
                            class="p-0"
                            value="5">{{ lang.Jun }}</option>
                        <option
                            class="p-0"
                            value="6">{{ lang.Jul }}</option>
                        <option
                            class="p-0"
                            value="7">{{ lang.Aug }}</option>
                        <option
                            class="p-0"
                            value="8">{{ lang.Sep }}</option>
                        <option
                            class="p-0"
                            value="9">{{ lang.Oct }}</option>
                        <option
                            class="p-0"
                            value="10">{{ lang.Nov }}</option>
                        <option
                            class="p-0"
                            value="11">{{ lang.Dec }}</option>
                    </select>
                    <select
                        :class="[errors.day != undefined ? 'is-invalid' : '', 'form-control']"
                        v-model="day"
                        name="day"
                        required>
                        <option
                            class="p-0"
                            value="0"
                            disabled>{{ lang.day }}</option>
                        <option
                            v-for="i in 31"
                            :value="i"
                            :key="i"
                            class="p-0">{{ i }}</option>
                    </select>
                    <select
                        :class="[errors.year != undefined ? 'is-invalid' : '', 'form-control']"
                        v-model="year"
                        name="year"
                        required>
                        <option
                            class="p-0"
                            value="0"
                            disabled>{{ lang.year }}</option>
                        <option
                            v-for="i in years"
                            :value="i"
                            :key="i"
                            class="p-0">{{ i }}</option>
                    </select>
                    <i
                        :title="lang.birthdate_tip"
                        class="fas fa-info-circle birthday-tip position-relative"
                        data-toggle="tooltip"
                        data-placement="top"/>
                    <div
                        v-if="errors.year != undefined || errors.month != undefined || errors.day != undefined"
                        class="error-msg">
                        {{ lang.birthdate_error }}
                    </div>
                </div>
                <div
                    v-if="!email_registered"
                    class="form-group mx-auto mb-2 position-relative">
                    <label class="text-11 my-0 fw-200">
                        <input
                            v-model="marketing_opt_in"
                            type="checkbox"
                            name="marketing_opt_in"
                            class="mr-1"
                            value="true">
                        {{ lang.marketing_opt_in }}
                    </label>
                    <i
                        :title="lang.marketing_opt_in_tip"
                        class="fas fa-info-circle marketing-opt-in-tip"
                        data-toggle="tooltip"
                        data-placement="top"/>
                    <br>
                    <a
                        id="print-terms"
                        class="text-8 fw-200 mb-2 d-inline-block pt-1 pb-3"
                        href="/v3/terms"
                        target="_blank">{{ lang.print_terms }}</a>
                </div>
                <div
                    v-if="errors.teacher_registration_code != undefined"
                    class="error-msg mb-2 text-center">
                    {{ errors.teacher_registration_code[0] }}
                </div>
                <button
                    v-if="!email_registered"
                    id="create_account"
                    type="submit"
                    class="btn btn-primary btn-round d-block w-200px mx-auto mb-3 btn-drop-shadow text-18">
                    {{ lang.create_account }}
                </button>
                <p
                    v-if="!email_registered"
                    class="text-14 my-0 fw-200">{{ lang.sign_in_message }}
                    <a
                        :href="login_url"
                        class="parent_login fw-600">{{ lang.sign_in }}</a>
                </p>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        csrf: {
            type: String,
            default: ''
        },
        login_url: {
            type: String,
            default: ''
        },
        old: {
            type: Array,
            default: null
        },
        register_url: {
            type: String,
            default: ''
        },
        social_register_url: {
            type: String,
            default: ''
        },
        home_url: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            year: 0,
            month: -1,
            day: 0,
            first_name: '',
            last_name: '',
            email: '',
            email_confirmation: '',
            phone: '',
            password: '',
            errors: [],
            email_registered: false,
            marketing_opt_in: false
        };
    },
    computed: {
        years: function () {
            return _.range((new Date()).getFullYear(), 1927, -1);
        },
        lang () {
            return this.$store.state.lang;
        },
        isSocialRegistration () {
            if (this.$store.getters.getUserType === 'incompleteProfile') {
                return true;
            }
            return false;
        }
    },
    mounted: function () {
        // load all tooltips
        $('[data-toggle="tooltip"]').tooltip();

        if (this.$store.getters.getUserType === 'incompleteProfile') {
            this.old = this.$store.state.User;
        }
        let missingBirthday = this.old.year > 0 &&
            this.old.month > 0 &&
            this.old.day > 0;
        let incompleteProfile = this.$store.getters.getUserType === 'incompleteProfile';
        if (missingBirthday || incompleteProfile) {
            this.year = Number(this.old.year);
            this.month = Number(this.old.month);
            this.day = Number(this.old.day);
            this.first_name = this.old.first_name;
            this.last_name = this.old.last_name;
            this.email = this.old.email;
            this.email_confirmation = this.old.email_confirmation;
            this.phone = this.old.phone;
            this.marketing_opt_in = this.old.marketing_opt_in;
        }
    },
    methods: {
        _verify (event) {
            if (this.year === 0 || this.month === -1 || this.day === 0) {
                if (event) event.preventDefault();
                this.year === 0 ? this.errors.year = true : this.errors.year = undefined;
                this.month === -1 ? this.errors.month = true : this.errors.month = undefined;
                this.day === 0 ? this.errors.day = true : this.errors.day = undefined;
                this.$forceUpdate();
                return;
            }

            var bd = new Date(this.year + 18, +this.month, this.day);
            if (bd >= (new Date())) {
                if (event) event.preventDefault();
                this.$emit('registration-error');
            } else {
                event.preventDefault();
                this.register();
            }
        },
        _validateEmail () {
            // prevent ajax if the email is blank and reset the form
            if (this.email === '') {
                this.reset_form();
                return;
            }

            axios.post('/v3/api/register/email-address', { 'emailAddress': this.email })
                .then(response => {
                    if (response.data.email_available === false) {
                        this.email_registered = true;
                    } else if (this.email_registered === true && response.data.email_available === true) {
                        this.reset_form();
                    }
                })
                .catch(error => {
                    // Lets fail back to the normal post validations if ajax gets an error
                    this.reset_form(error);
                });
        },
        register: function () {
            let postUrl = this.isSocialRegistration ? this.social_register_url : this.register_url;
            let postData = {
                csrf: this.csrf,
                year: this.year,
                month: this.month,
                day: this.day,
                first_name: this.first_name,
                last_name: this.last_name,
                phone: this.phone,
                is_social_registration: this.isSocialRegistration,
                teacher_registration_code: this.$parent.teacher_registration_code,
                marketing_opt_in: this.marketing_opt_in
            };
            if (!this.isSocialRegistration) {
                postData.email = this.email;
                postData.email_confirmation = this.email_confirmation;
                postData.password = this.password;
            }
            axios.post(postUrl, postData)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('registration-successful', response);
                    } else {
                        this.showErrors(response.errors);
                    }
                })
                .catch(error => {
                    this.showErrors(error.response);
                });
        },
        reset_form () {
            this.email_confirmation = '';
            this.email_registered = false;
        },
        showErrors (errors) {
            this.errors = errors.data.errors;
            console.error('show errors: Not Yet Implemented');
            console.error(errors);
        }
    }

};
</script>

<style scoped>
    a.btn{
        color:#fff;
    }
    #email-registered-error{
        font-size:15px !important;
    }
</style>
