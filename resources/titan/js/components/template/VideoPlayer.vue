<template>
  <div>
    <figure class="image is-16by9 mb-4">
      <VideoIframe :video-id="activeVideo.external_video_id" :source="activeVideo.source"/>
    </figure>

    <BTabs v-model="activeTab">
      <BTabItem v-for="(videoCollection, index) in videoCollections" :key="index">
        <template slot="header">
          <span class="text-xl font-medium">{{ videoCollection.title }}</span>
        </template>
        <VideoGallery
          :videos="videoCollection.videos"
          :selected-video-id="activeVideo.external_video_id"
          @videoSelected="updateActiveVideo"
        />
      </BTabItem>
    </BTabs>
  </div>
</template>

<script>
import VideoGallery from "./VideoGallery";

export default {
  name: "VideoPlayer",
  status: "prototype",
  release: "1.0",
  components: {
    VideoGallery
  },
  props: {
    videoCollections: {
      type: Array,
      default: () => []
    },
    presetVideo: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      activeTab: 0,
      tabsDisabled: true,
      activeVideoIndex: undefined,
      activeTabKey: undefined,
      selectedVideo: null
    };
  },
  computed: {
    activeVideo() {
      return this.selectedVideo ? this.selectedVideo : this.presetVideo;
    }
  },
  methods: {
    updateActiveVideo(video) {
      this.selectedVideo = video;
    }
  }
};
</script>

<style lang="scss">
.b-tabs {
  .tab-content {
    padding: 0;
  }
}
</style>
