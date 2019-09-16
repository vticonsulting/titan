<template>
  <section class="section is-paddingless min-h-screen">
    <div>
      <main>
        <div class="mx-4 md:mx-0 pb-4">
          <div class="student-info border-b mb-10 pb-10">
            <div class="max-w-md md:mx-auto">
              <div class="add-photo mb-8">
                <div class="flex items-center justify-start">
                  <AvatarImage />

                  <button class="button is-rounded is-secondary px-6 ml-10">
                    Upload Photo
                  </button>
                </div>
              </div>

              <h2 class="text-lg font-semibold mb-4">
                Student Information
              </h2>

              <BField
                label="Student First Name"
                custom-class="font-normal"
              >
                <BInput
                  placeholder="First Name"
                  value=""
                />
              </BField>
              <BField
                label="Student Last Name"
                custom-class="font-normal"
              >
                <BInput
                  placeholder="Last Name"
                  value=""
                />
              </BField>
              <BField
                label="Classroom"
                custom-class="font-normal"
              >
                <BSelect
                  placeholder="Select a classroom"
                  expanded
                >
                  <option value="1">
                    Mrs. Smith
                  </option>
                  <option value="2">
                    Option 2
                  </option>
                </BSelect>
              </BField>
            </div>
          </div>

          <div class="family-pledging border-b mb-10 pb-10">
            <div class="max-w-md md:mx-auto">
              <div class="flex items-center mb-6">
                <h2 class="text-lg font-semibold mr-6">
                  Enable Family Pledging
                </h2>
                <img
                  src="/assets/dashboard/images/family-pledging.png"
                  style="width: 36px; height: 36px;"
                  alt=""
                >
              </div>

              <div class="field">
                <BSwitch
                  :value="true"
                  type="is-tertiary"
                />
              </div>

              <p class="text-sm">
                Family pledging allows you to share a family pledge page for all of your participants so that they can be pledged at once!
              </p>
            </div>
          </div>

          <div class="pledge-goal border-b mb-10 pb-10">
            <div class="max-w-md md:mx-auto">
              <h2 class="text-lg font-semibold mb-4">
                Pledge Goal: Per Reading Challenge
              </h2>
              <label
                class="text-sm"
                for="goal-amount"
              >
                Goal Amount
              </label>
              <div class="flex items-center">
                <div>
                  <input
                    id="goal-amount"
                    class="input font-bold w-16 sm:w-32"
                    value="$10"
                  >
                </div>
                <div class="font-bold px-2 sm:px-4 text-lg">
                  =
                </div>
                <div class="leading-none">
                  <span class="font-bold text-lg">
                    $300 to $350
                  </span><br>
                  <span class="text-xs">
                    $1 Per Reading Challenge = $30 to $35
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="pledge-page-message mb-10">
            <div class="max-w-md md:mx-auto">
              <h2 class="text-lg font-semibold mb-2">
                Pledge Page Message
              </h2>

              <div class="editor">
                <EditorMenuBar :editor="editor">
                  <div
                    slot-scope="{ commands, isActive }"
                    class="field has-addons"
                    style="margin-bottom: -1px"
                  >
                    <p class="control">
                      <button
                        :class="['button', { 'is-active': isActive.bold() }]"
                        @click="commands.bold"
                      >
                        <span class="icon is-small">
                          <FontAwesomeIcon :icon="['fas', 'bold']" />
                        </span>
                        <span>Bold</span>
                      </button>
                    </p>

                    <p class="control">
                      <button
                        :class="['button', { 'is-active': isActive.italic() }]"
                        @click="commands.italic"
                      >
                        <span class="icon is-small">
                          <FontAwesomeIcon :icon="['fas', 'italic']" />
                        </span>
                        <span>Italic</span>
                      </button>
                    </p>

                    <p class="control">
                      <button
                        :class="['button', { 'is-active': isActive.underline() }]"
                        @click="commands.underline"
                      >
                        <span class="icon is-small">
                          <FontAwesomeIcon :icon="['fas', 'underline']" />
                        </span>
                        <span>Underline</span>
                      </button>
                    </p>
                  </div>
                </EditorMenuBar>

                <EditorContent
                  :editor="editor"
                  class="editor__content border p-2 mb-10"
                />
              </div>
            </div>
          </div>

          <div class="text-center mb-10 pb-10">
            <div class="max-w-md md:mx-auto">
              <div>
                <button class="button is-secondary is-rounded inline-block mb-4 w-64">
                  Save
                </button><br>
                <button class="button is-secondary is-rounded inline-block mb-4 w-64 is-outlined">
                  Cancel
                </button>
              </div>

              <a
                class="inline-block mb-4"
                href="https://funrun.boosterthon.com/profile/update_student_profile#"
                target="_new"
              >
                View Participant Agreement
              </a><br>
              <button
                v-tooltip="tooltipOptions"
                :disabled="false"
                class="text-red"
                href="#"
                @click="deleteStudent"
              >
                Delete Student
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </section>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import { Bold, Italic, Link, Underline } from 'tiptap-extensions'

export default {
  name: 'EditParticipant',
  status: 'prototype',
  release: '1.0.0',
  components: {
    EditorContent,
    EditorMenuBar
  },
  data() {
    return {
      editor: new Editor({
        extensions: [
          new Bold(),
          new Italic(),
          new Link(),
          new Underline()
        ],
        content: `Welcome to my pledge page! I am doing a cool program called the ABC Run. We're raising money for our school and learning about fitness, leadership, and character. On July 31, 2019, I'll complete laps at the ABC Run to help my school. Would you please be one of my sponsors? I can't wait to participate with all of my classmates. I'll tell you how many laps I completed after the ABC Run! Thanks for sponsoring me!`
      })
    }
  },
  computed: {
    tooltipOptions() {
      return {
        classes: ['info'],
        content:
          'This participant has pledges or payments associated so he/she cannot be deleted. Please go to our "Help Desk" for any questions.',
        placement: 'auto',
        trigger: 'hover click focus'
      }
    }
  },
  beforeDestroy() {
    this.editor.destroy()
  },
  methods: {
    deleteStudent() {
      this.$dialog.confirm({
        title: 'Deleting Student',
        message: `You are about to delete this participant? Are you sure you want to continue?`,
        cancelText: 'No',
        confirmText: 'Yes',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => this.$toast.open({
          duration: 3000,
          message: `Student has been deleted`,
          position: 'is-top',
          type: 'is-danger'
        })
      })
    }
  }
}
</script>

<style lang="scss">
.editor__content {
  > div {
    padding: 1rem;
  }
}
</style>
