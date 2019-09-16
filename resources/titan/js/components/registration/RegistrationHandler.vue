<template>
    <div>
        <progress-bar :width="pg_width"/>
        <div
            v-if="position == 'welcome'"
            class="classic-banner z-2000 bg-dkblue text-white text-center">
            You're viewing our new site! <a
                href="/v3/classic-signup-registration"
                class="text-white"><u>Click here to go back</u></a>
        </div>
        <back
            v-if="showBackButton"
            @back-button="_back"/>
        <div class="registration">
            <welcome
                v-if="position=='welcome'"
                :login_url="login_url"
                class="animated fadeIn animated-slow"
                @register="_setPosition()"
            />
            <registration-type
                v-if="position == 'registration-type'"
                :lang="lang"
                :login_url="login_url"
                class="animated fadeIn animated-slow"
                @email-registration="_setPosition()"/>
            <registration-form
                v-if="position == 'registration'"
                :old="old"
                :csrf="csrf"
                :errors="errors"
                :login_url="login_url"
                :register_url="register_url"
                :social_register_url="social_register_url"
                class="animated fadeIn animated-slow"
                @registration-successful="_setPosition()"
                @registration-error="_error()"/>
            <welcome-back
                v-if="position == 'welcome-back'"
                @selection-made="_setPosition()"/>
            <welcome-teachers
                v-if="position == 'welcome-teacher'"
                :lang="lang"
                :login_url="login_url"
                class="animated fadeIn animated-slow"
                @teacher_registered="_setPosition()"/>
            <school-search
                v-if="position == 'school-search'"
                :old="old"
                :csrf="csrf"
                :errors="errors"
                :login_url="login_url"
                :register_url="register_url"
                class="animated fadeIn animated-slow auth-pane"
                @participant-registration="_setPosition"
                @registration-error="_error()"/>
            <participant-form
                v-if="position == 'participant-registration'"
                class="animated fadeIn animated-slow auth-pane"
                @participant-registered="_setPosition()"
            />
            <participant-register-success
                v-if="position == 'participant-register-success'"
                class="animated fadeIn animated-slow"
                @school-search="_setPosition()"
            />
            <div
                v-if="position === 'error'"
                class="animated fadeIn animated-slow">
                <h4 class="mt-12">{{ lang.register_error }}</h4>
                <p class="mt-8">{{ lang.redirect_message }}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        lang: {
            type: Object,
            default: null
        },
        login_url: {
            type: String,
            default: ''
        },
        csrf: {
            type: String,
            default: ''
        },
        errors: {
            type: Array,
            default: null
        },
        welcome_page: {
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
        },
        user: {
            type: Object,
            default: undefined
        },
        default_image_url: {
            type: String,
            default: null
        },
        user_type: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            position: 'welcome',
            pg_width: 'd-none',
            agrees_terms: false,
            teacher_registration_code: null,
            parent: false,
            positions: {
                'welcome': {
                    width: 'd-none',
                    back: false,
                    step: 1,
                    teacher: true,
                    parent: true
                },
                'registration-type': {
                    width: 'w-20pct',
                    back: true,
                    step: 2,
                    teacher: true,
                    parent: true
                },
                'registration': {
                    width: 'w-40pct',
                    back: true,
                    step: 3,
                    teacher: true,
                    parent: true
                },
                'welcome-teacher': {
                    width: 'w-100pct',
                    back: false,
                    step: 4,
                    teacher: true,
                    parent: false
                },
                'school-search': {
                    width: 'w-60pct',
                    back: false,
                    step: 4,
                    teacher: false,
                    parent: true
                },
                'participant-registration': {
                    width: 'w-80pct',
                    back: true,
                    step: 5,
                    teacher: false,
                    parent: true
                },
                'participant-register-success': {
                    width: 'hide',
                    back: false,
                    step: 6,
                    teacher: false,
                    parent: true
                },
                'error': {
                    width: 'd-none',
                    back: false,
                    step: -1,
                    teacher: true,
                    parent: true
                },
                'welcome-back': {
                    width: 'w-20pct',
                    back: false,
                    step: 3,
                    teacher: false,
                    parent: false
                }
            }
        };
    },
    computed: {
        loggedIn () {
            if (this.$store.state.user !== undefined) { return true; }
            return false;
        },
        showBackButton () {
            return this.positions[this.position].back;
        }
    },
    watch: {
        position: function (val) {
            this.pg_width = this.positions[val].width;
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    },
    mounted: function () {
        // Load the lang into the store
        this.$store.commit('set_lang', this.lang);
        this.$store.commit('set_user_type', this.user_type);
        // If there is old data lets load directly to the registration page that failed.
        if (this.errors.length !== 0) {
            this.position = 'registration';
            this.teacher_registration_code = this.old.teacher_registration_code;
        }
        if (this.user !== null) {
            this.$store.commit('set_user', this.user);
            switch (this.$store.getters.getUserType) {
            case 'parent':
                this.position = 'school-search';
                break;
            case 'teacher':
                this.position = 'welcome-teacher';
                break;
            case 'incompleteProfile':
                this.position = 'registration';
                break;
            default:
                this.position = 'welcome-back';
                break;
            }
        }
        this.$store.commit('set_default_user_image', this.default_image_url);
    },
    methods: {
        _back: function () {
            if (this.position === 'registration') {
                axios.get('/v3/logout');
                this.$store.commit('reset_user');
            }
            let newPosition = _.findIndex(
                _.toArray(this.positions),
                {'step': this.positions[this.position].step, [this.$store.state.user_type]: true}
            );

            this.position = Object.keys(this.positions)[newPosition - 1];
        },
        _error: function () {
            this.position = 'error';
            setTimeout(() => {
                window.location.href = '/';
            }, 60000);
        },
        _setPosition: function () {
            if (this.positions[this.position].step === 6) {
                this.position = 'school-search';
                return;
            }
            let nextStep = _.findIndex(_.toArray(this.positions), { 'step': this.positions[this.position].step + 1, [this.$store.state.user_type]: true });

            // Flip back to dashboard if there isn't another step to take.
            if (nextStep === -1) { window.location.href = '/v3/tkdashboard'; }

            this.position = Object.keys(this.positions)[nextStep];
        }

    }
};
</script>

<style scoped>
.auth-pane{
    width:245px;
    margin:auto;
}

.classic-banner {
    width: 100%;
    left: 0;
    top: 0;
    position: fixed !important;
}
</style>
