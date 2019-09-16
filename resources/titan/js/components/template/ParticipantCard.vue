<template>
  <div class="participant-card border lg:border-0 rounded-lg lg:rounded-none shadow-lg lg:shadow-none mb-12 lg:mb-0 mx-auto max-w-xl">
    <!-- mx-4 xl:mx-auto pb-4 -->
    <div class>
      <div class="media p-4 relative">
        <div class="media-left">
          <a :href="editProfileLink">
            <AvatarImage
              :alt="participant.first_name"
              :src="avatarSrc"
            />
          </a>
        </div>
        <div class="media-content self-center">
          <h2 class="text-xl">
            {{ participant.first_name }}
          </h2>
        </div>
        <div class="media-right self-start has-text-right">
          <a
            :href="editProfileLink"
            class="text-sm has-text-grey"
          >Edit</a>
        </div>
      </div>
    </div>

    <section class="px-6">
      <div
        class="mb-4"
        style="display: block"
      >
        <ProgressMeter
          :width="40"
          color="#2db564"
        />
        <div class="mt-2">
          <h3 class="font-bold">
            Total Pledged: $4 of 10
          </h3>
          <h4 class="text-sm">
            Per Reading Challenge
          </h4>
        </div>
      </div>
      <div class="mb-4">
        <RewardsCarousel />
      </div>
    </section>
  </div>
</template>
<script>
import RewardsCarousel from './RewardsCarousel'

export default {
  name: 'ParticipantCard',
  status: 'prototype',
  release: '1.0.0',
  components: {
    RewardsCarousel
  },
  props: {
    participant: {
      type: Object,
      default: null
    }
  },
  computed: {
    avatarSrc() {
      return this.participant.profile.image_name == null
        ? '/assets/dashboard/images/dashboard-avatar.svg'
        : this.avatarImgSrc
    },
    avatarImgSrc() {
      return (
        this.$store.getters.avatarPath + this.participant.profile.image_name
      )
    },
    editProfileLink() {
      return (
        '/v3/tkdashboard/?redirect=' +
        encodeURI(
          'auth/login/' + this.participant.fr_code + '/edit-personalize'
        )
      )
    }
  }
}
</script>
