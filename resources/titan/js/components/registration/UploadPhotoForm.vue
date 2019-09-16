<template>
  <div>
    <div class="w-150px position-relative mx-auto">
      <croppa
        v-model="myCroppa"
        :zoom-speed="15"
        :width="150"
        :height="150"
        :show-remove-button="false"
        :placeholder="''"
        class="croppa-image"
        @new-image-drawn="initialMetadata=myCroppa.getMetadata()"
        @draw="drawCount++"
      >
        <img
          slot="placeholder"
          :src="initialImage"
        >
      </croppa>
    </div>
    <label class="mx-auto btn-sm btn-primary w-50px upload-photo-btn mb-2">
      <i class="text-white fas fa-camera text-20" />
      <input
        name="profile_image"
        hidden
        @click="myCroppa.chooseFile()"
      >
    </label>
    <div
      :class="{'invisible' : !hasImage}"
      class="delete-photo-btn cursor-pointer text-danger mb-2 text-14"
      @click="deleteImage()"
    >
{{ lang.delete_photo }}
</div>
    <div class="buttons mb-4 mx-auto w-150px d-flex justify-content-between">
      <button
        class="btn btn-default image-control text-10"
        @click="myCroppa.rotate(-1)"
      >
<i class="fas fa-undo" />
</button>
      <button
        class="btn btn-default image-control text-10"
        @click="myCroppa.zoomOut()"
      >
<i class="fas fa-minus" />
</button>
      <button
        class="btn btn-default image-control text-10"
        @click="resetImage()"
      >
<i class="fas fa-expand-arrows-alt" />
</button>
      <button
        class="btn btn-default image-control text-10"
        @click="myCroppa.zoomIn()"
      >
<i class="fas fa-plus" />
</button>
      <button
        class="btn btn-default image-control text-10"
        @click="myCroppa.rotate(1)"
      >
<i class="fas fa-redo" />
</button>
    </div>
    <button
      :disabled="!isSavable"
      class="image-upload-save-btn btn btn-round btn-primary mb-3 w-150px fw-400 text-18 w-200px"
      data-dismiss="modal"
      @click="saveImage"
    >
{{ lang.save }}
</button>
    <p
      :class="{'invisible' : !hasImage}"
      class="text-14 mw-250px mx-auto"
    >
{{ lang.student_star_wait }}
</p>
  </div>
</template>

<script>

export default {
  props: {
    lang: {
      type: Object,
      default: null
    }
  },
  data () {
    return {
      myCroppa: null,
      initialImage: '/assets/dashboard/images/userpic_60px.svg',
      initialMetadata: null,
      initialImageUrl: null,
      drawCount: 0
    }
  },
  computed: {
    hasImage () {
      if (this.myCroppa) {
        return this.myCroppa.hasImage()
      }
      return false
    },
    isSavable () {
      if (this.myCroppa && this.drawCount) {
        return this.initialImageUrl !== this.myCroppa.generateDataUrl()
      }
      return false
    }
  },
  mounted () {
    this.initialImageUrl = this.myCroppa.generateDataUrl()
    // subscription used to refresh on secon participant
    this.$store.subscribe((event, payload) => {
      if (event.type === 'new_participant') {
        this.myCroppa.remove()
        this.initialImageUrl = this.myCroppa.generateDataUrl()
      }
    })
  },
  methods: {
    resetImage () {
      this.myCroppa.applyMetadata(this.initialMetadata)
    },
    saveImage () {
      this.initialImageUrl = this.myCroppa.generateDataUrl()
      this.$store.commit('set_user_photo', this.initialImageUrl ? this.initialImageUrl : undefined)
      this.$emit('photo-changed')
    },
    deleteImage () {
      this.myCroppa.remove()
    }
  }
}
</script>

<style scoped>
.upload-photo-btn {
  border-radius: 8px;
  box-shadow: 0px 2px 4px #777;
  cursor: pointer;
}

.btn-default {
  color: #333;
  background-color: #eee;
  border-color: #ccc;
}

.image-control {
  line-height: 11px;
  padding: 6px 7px;
}

.default-profile-image {
  height: 150px;
  width: 150px;
  position: absolute;
  top: 0;
  left: 0;
  cursor: pointer;
}
.croppa-image {
  border-radius: 5px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -ms-border-radius: 5px;
  -o-border-radius: 5px;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.5);
}
.croppa-image >>> canvas {
  border-radius: 5px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -ms-border-radius: 5px;
  -o-border-radius: 5px;
}
</style>
