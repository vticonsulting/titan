<template>
  <div>
    <h1 :class="[family_pledging ? '' : 'mb-46px', 'text-28 fw-200 d-block mt-8']">
{{ lang.participant_registration.register_student }}
</h1>
    <form @submit.prevent="submit">
      <div
        id="upload-photo"
        data-toggle="modal"
        data-target="#uploadPhotoModal"
        class="cursor-pointer"
      >
        <img
          :src="img"
          class="profile-picture"
        >

        <input
          class="avatar d-block mx-auto"
          name="profile_picture"
          type="file"
        >
        <label
          class="text-15 d-block mx-auto cursor-pointer font-weight-bold"
          for="profile_picture"
        >
          <u>{{ photoText }}</u>
          <p
            v-if="showOptional"
            class="text-12 fw-300"
          >{{ lang.participant_registration.optional }}</p>
        </label>
      </div>
      <div v-if="errors">
        <ul
          v-for="(error, key) in errors"
          :key="key"
          class="alert alert-danger p-4"
        >
          <li
            v-for="(message, index) in error"
            :key="index"
            class="error-list-item text-danger"
          >
{{ message }}
</li>
        </ul>
      </div>
      <text-input
        :class="{'mb-20px': family_pledging}"
        v-model="first_name"
        :label="lang.participant_registration.student_first_name"
        type="text"
        name="first_name"
        required
      />
      <text-input
        :class="{'mb-28px': !family_pledging}"
        v-model="last_name"
        :label="lang.participant_registration.student_last_name"
        type="text"
        name="last_name"
        required
      />

      <selection-input
        :class="[{'mb-28px': !family_pledging}, 'blue-rounded']"
        :default_value="null"
        v-model="classroom"
        :default_text="lang.participant_registration.select_classroom"
        name="classroom"
        required
      >
        <option
          v-for="(value, key) in school.classrooms"
          :key="key"
          :value="value.id.toString()"
        >
{{ value.name }}
</option>
      </selection-input>
      <div v-if="family_pledging">
        <img
          class="fp-icon"
          src="/assets/dashboard/images/family_pledging.svg"
        >
        <p class="text-14 mb-4px fw-300">
{{ lang.participant_registration.enable_family_pledging }}
</p>
        <p class="text-10 mb-10px fw-300">
{{ lang.participant_registration.family_pledging_text }}
</p>

        <toggle-input
          v-model="family_pledging_toggle"
          class=""
          name="family_pledging"
          true
          color="#FF7B02"
        />
      </div>

      <input
        v-model="terms"
        class="checkbox"
        name="participation_terms"
        type="checkbox"
        required
      >
      <label class="text-12 mb-5px checkbox-label">{{ lang.participant_registration.participation_terms }}</label>
      <br>
      <a
        id="print-terms"
        :class="[family_pledging ? 'mb-18px' : 'mb-20px', 'text-8 d-inline-block fw-300']"
        href="/v3/terms"
        target="_blank"
      >{{ lang.print_terms }}</a>
      <button
        :disabled="submitting"
        type="submit"
        class="btn btn-primary btn-round d-block w-200px mx-auto mb-1 btn-drop-shadow text-18"
      >
{{ lang.participant_registration.add_student }}
        <i
          v-if="submitting"
          class="fa fa-spinner fa-spin"
        />
</button>
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      first_name: '',
      last_name: '',
      classroom: null,
      family_pledging_toggle: true,
      terms: false,
      img: null,
      photoText: '',
      showOptional: true,
      errors: null,
      submitting: false
    }
  },
  computed: {
    family_pledging_selection: function () {
      if (
        this.family_pledging === true &&
        this.family_pledging_toggle === true
      ) {
        return true
      }
      return false
    },
    school () {
      return this.$store.state.User.participants[this.participant_num - 1]
        .school
    },
    family_pledging () {
      let participants = this.$store.state.User.participants
      let participantsInProgram = participants.filter(participant => {
        return participant.school.program_id === this.school.program_id
      })
      let hasMultipleParticipantsInProgram = participantsInProgram.length > 1
      if (
        hasMultipleParticipantsInProgram &&
        this.school.family_pledging_enabled
      ) {
        return true
      }
      return false
    },
    lang () {
      return this.$store.state.lang
    },
    participant_num () {
      return this.$store.state.User.participants.length
    },
    User () {
      return this.$store.state.User
    }
  },
  mounted () {
    this.showUploadText()
    this.img = this.img_url()
    this.$store.subscribe((event, payload) => {
      if (event.type === 'set_user_photo') {
        this.img = this.img_url()
      }
    })
  },
  methods: {
    submit: function () {
      this.submitting = true
      let formData = {
        firstName: this.first_name,
        lastName: this.last_name,
        classroomId: this.classroom,
        isFamilyPledgingEnabled: this.family_pledging_selection,
        isAgreed: this.terms,
        imageB64Url: this.img
      }
      axios
        .post('/v3/register/participant', formData)
        .then(response => {
          let participant = {
            index: this.participant_num - 1,
            data: response.data
          }
          this.$store.commit('update_participant', participant)
          this.$emit('participant-registered')
        })
        .catch(error => {
          this.errors = JSON.parse(error.request.response).errors
        })
        .finally(() => {
          this.submitting = false
        })
    },
    showUploadText () {
      this.photoText = this.lang.participant_registration.upload_photo
      this.showOptional = true
    },
    showEditText () {
      this.photoText = this.lang.participant_registration.edit_photo
      this.showOptional = false
    },
    img_url () {
      if (
        this.$store.state.User.participants[this.participant_num - 1]
          .photo_url === undefined
      ) {
        this.showUploadText()
        return this.$store.state.default_user_image
      }
      this.showEditText()
      return this.$store.state.User.participants[this.participant_num - 1]
        .photo_url
    },
    getImageBlob () {
      let block = this.img.split(';')
      let contentType = block[0].split(':')[1]
      let realData = block[1].split(':')[1]
      let blob = this.b64toBlob(realData, contentType)
      return blob
    },
    b64toBlob (b64Data, contentType, sliceSize) {
      contentType = contentType || ''
      sliceSize = sliceSize || 512

      var byteCharacters = atob(b64Data)
      var byteArrays = []

      for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize)

        var byteNumbers = new Array(slice.length)
        for (var i = 0; i < slice.length; i++) {
          byteNumbers[i] = slice.charCodeAt(i)
        }

        var byteArray = new Uint8Array(byteNumbers)

        byteArrays.push(byteArray)
      }

      var blob = new Blob(byteArrays, { type: contentType })
      return blob
    }
  }
}
</script>

<style scoped>
.fp-icon {
  width: 36px;
  height: 36px;
}

.fp-toggle > div {
  height: 24px;
  width: 54px;
  border-radius: 12px;
  background-color: #ff7b02;
}
.avatar {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.checkbox {
  margin-right: 6px;
  display: inline;
}
.checkbox-label {
  display: inline;
  padding: 0px;
}
.profile-picture {
  width: 77px;
  height: 77px;
}
.error-list-item {
  list-style: none;
}
</style>
