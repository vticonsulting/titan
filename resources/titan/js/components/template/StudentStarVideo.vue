<template>
  <div class="student-star-video card-content py-4 px-8">
    <Slick v-if="participantVideoIds" ref="slick" :options="slickOptions">
      <figure
        v-for="(videoId, index) in participantVideoIds"
        :key="index"
        class="image is-16by9 mb-8"
      >
        <VideoIframe :video-id="videoId" source="jwplayer"/>
      </figure>
    </Slick>
    <figure v-else class="image is-16by9 mb-8">
      <VideoIframe :video-id="videoId"/>
    </figure>

    <h2 class="text-lg font-semibold">Easily Get Pledges!</h2>

    <p v-if="canShare" class="mb-8">
      Share your customized Student Star Video! This video stars your student and asks for
      pledges for you. Simply share your video using the share buttons below to easily get
      pledges from family and friends.
    </p>

    <p v-else class="mb-8">
      Upload a photo of your student to create a personalized Student Star video! This video
      not only stars your student, but it also encourages family and friends to pledge.
    </p>

    <div class="xl:flex items-center mb-10">
      <div
        v-for="participant in program.participants"
        :key="participant.id"
        class="student-info w-full flex p-4 relative has-background-white-bis border rounded-lg mb-4"
      >
        <StudentStarVideoCard :participant="participant"/>
      </div>
    </div>

    <div v-if="canShare" class="mx-auto max-w-sm">
      <ShareButtons/>
    </div>
  </div>
</template>

<script>
import ShareButtons from "../pattern/ShareButtons";
import StudentStarVideoCard from "./StudentStarVideoCard";
import Slick from "vue-slick";

export default {
  name: "StudentStarVideo",
  status: "prototype",
  release: "1.0.0",
  components: {
    ShareButtons,
    StudentStarVideoCard,
    Slick
  },
  props: {
    program: {
      type: Object,
      default: null
    },
    videoId: {
      type: [String, Number],
      default: "279542990"
    }
  },
  data() {
    return {
      slickOptions: {
        slidesToShow: 1,
        dots: true,
        autoplay: false,
        arrows: false,
        mobileFirst: true
      }
    };
  },
  computed: {
    lang() {
      return this.$store.state.lang;
    },
    canShare() {
      return this.program.participants.find(
        participant => participant.profile.image_name !== null
      );
    },
    participantVideoIds() {
      return this.program.participants.map(
        participant => participant.profile.video_url
      );
    }
  },
  methods: {
    next() {
      this.$refs.slick.next();
    },
    prev() {
      this.$refs.slick.prev();
    }
  }
};
</script>

<style>
@media (min-width: 992px) {
  .student-info:not(:last-child) {
    margin-right: 1rem;
  }
}

@media (min-width: 1200px) {
  .student-info:not(:last-child) {
    margin-right: 2rem;
  }
}
</style>
