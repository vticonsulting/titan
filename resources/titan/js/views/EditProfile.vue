<template>
  <section class="section is-paddingless min-h-screen">
    <div class="mx-4 md:mx-0 pb-4">
      <div class="max-w-md md:mx-auto">
        <div class="flex justify-end">
          <span v-tooltip="tooltipOptions" class="icon">
            <FontAwesomeIcon :icon="['fas', 'question-circle']" size="xs" class="has-text-info"/>
          </span>
        </div>

        <form @submit.prevent="handleSubmit">
          <legend class="text-lg font-semibold mb-4">Your Info (Parent, Guardian, or Teacher)</legend>
          <BField :type="false ? 'is-success': ''" label="First Name" custom-class="font-normal">
            <BInput
              placeholder="Your first name"
              required
              oninvalid="this.setCustomValidity('First name is required.')"
              oninput="setCustomValidity('')"
            />
          </BField>

          <BField label="Last Name" custom-class="font-normal">
            <BInput
              placeholder="Your last name"
              required
              oninvalid="this.setCustomValidity('Last name is required.')"
              oninput="setCustomValidity('')"
            />
          </BField>

          <BField
            :type="false ? 'is-danger' : ''"
            :message="false ? 'This email is invalid' : null"
            label="Email Address"
            custom-class="font-normal"
          >
            <BInput
              type="email"
              placeholder="Enter email address"
              required
              oninvalid="this.setCustomValidity('Email address is required.')"
              oninput="setCustomValidity('')"
            />
          </BField>

          <div class="field">
            <a
              class="inline-block my-6 underline"
              @click="showChangePasswordModal()"
            >Change Password</a>
          </div>

          <BField label="Phone Number" custom-class="font-normal">
            <BInput
              placeholder="Enter phone number"
              required
              oninvalid="this.setCustomValidity('Phone number is required.')"
              oninput="setCustomValidity('')"
            />
          </BField>

          <BField label="Birthday" custom-class="font-normal">
            <BInput
              type="date"
              placeholder="Your birthday"
              required
              oninvalid="this.setCustomValidity('Birthday is required.')"
              oninput="setCustomValidity('')"
            />
          </BField>

          <div class="text-center my-10 pb-10">
            <div class="max-w-md mx-0 md:mx-auto">
              <div>
                <button
                  type="submit"
                  class="button is-secondary is-rounded inline-block mb-4 w-64"
                >Save</button>
                <br>
                <RouterLink
                  :to="{ name: 'parent-dashboard' }"
                  class="button is-secondary is-rounded inline-block mb-4 w-64 is-outlined"
                >Cancel</RouterLink>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import ChangePasswordModal from "../components/pattern/ChangePasswordModal";

export default {
  name: "EditProfile",
  status: "prototype",
  release: "1.0.0",
  data() {
    return {
      isLoading: false,
      hasError: false
    };
  },
  computed: {
    tooltipOptions() {
      return {
        classes: ["info"],
        content:
          "We ask for your email to send you pledge notifications and payment details. Your phone number is if we need to confirm high value pledges.<br><br>Your date of birth helps us provide you with the right funrun.com experience for your age. We we will not display this.",
        placement: "auto-start",
        trigger: "hover click focus"
      };
    }
  },
  methods: {
    showChangePasswordModal() {
      this.$modal.open({
        parent: this,
        component: ChangePasswordModal,
        hasModalCard: true
      });
    },
    handleSubmit() {
      this.$toast("handleSubmit");
    }
  }
};
</script>
