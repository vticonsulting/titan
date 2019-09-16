<template>
  <div class="flex w-full">
    <div>
      <a :href="editProfileLink">
        <AvatarImage
          :alt="participant.first_name"
          :src="avatarSrc"
        />
      </a>
    </div>
    <div class="ml-4 flex-1 self-center">
      <h2 class="text-xl">
        {{ participant.first_name }}
      </h2>
    </div>
    <div class="self-center text-right">
      <span
        v-if="inProgress"
        class="font-bold has-text-tertiary"
      >
        Video in progress
      </span>
      <span
        v-else-if="readyToShare"
        class="font-bold has-text-primary"
      >
        Ready to share
      </span>
      <RouterLink
        v-else
        :to="{ name: 'edit-participant' }"
        class="button is-rounded is-secondary"
      >
        Upload Photo
      </RouterLink>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StudentStarVideoCard',
  props: {
    participant: {
      type: Object,
      default: function () {
        return {}
      }
    }
  },
  computed: {
    avatarSrc() {
      return this.participant.profile.image_name == null ? '/assets/dashboard/images/dashboard-avatar.svg' : this.avatarImgSrc
    },
    avatarImgSrc() {
      return this.$store.getters.avatarPath + this.participant.profile.image_name
    },
    editProfileLink() {
      return '/v3/tkdashboard/?redirect=' + encodeURI('auth/login/' + this.participant.fr_code + '/edit-personalize')
    },
    inProgress() {
      return this.participant.profile.image_name !== null && this.participant.profile.video_url == null
    },
    readyToShare() {
      return this.participant.profile.image_name !== null && this.participant.profile.video_url !== null
    }
  }
}
</script>
