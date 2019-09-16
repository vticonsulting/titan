<template>
  <div>
    <p
      class="text-center md:text-lg font-bold mb-4 px-12"
    >Add or import your contacts to send emails.</p>

    <div class="flex justify-center content-center mb-5">
      <div class="w-16 sm:w-24 flex flex-col flex-wrap text-center">
        <button
          class="shadow is-rounded border w-12 h-12 rounded-full mx-auto cursor-pointer"
          @click="showAddContactsModal"
        >
          <BaseIcon name="add-email"/>
        </button>
        <span class="text-xs">Add Contact</span>
      </div>
      <div class="w-16 sm:w-24 flex flex-col flex-wrap text-center">
        <button class="shadow is-rounded border w-12 h-12 rounded-full mx-auto cursor-pointer">
          <BaseIcon name="gmail"/>
        </button>
        <span class="text-xs">Gmail</span>
      </div>
      <div class="w-16 sm:w-24 flex flex-col flex-wrap text-center">
        <button class="shadow is-rounded border w-12 h-12 rounded-full mx-auto cursor-pointer">
          <BaseIcon name="yahoo"/>
        </button>
        <span class="text-xs">Yahoo</span>
      </div>
      <div class="w-16 sm:w-24 flex flex-col flex-wrap text-center">
        <button class="shadow is-rounded border w-12 h-12 rounded-full mx-auto cursor-pointer">
          <BaseIcon name="outlook"/>
        </button>
        <span class="text-xs">Outlook</span>
      </div>
    </div>
  </div>
</template>

<script>
import AddContactsModal from "./AddContactsModal";

export default {
  name: "AddContactsButtons",
  components: {},
  methods: {
    showAddContactsModal() {
      this.$emit("close");
      this.$parent.$emit("close");
      this.$modal.open({
        parent: this,
        component: AddContactsModal,
        hasModalCard: true,
        width: "auto",
        onCancel: this.unBlur
      });
      document.getElementById("app").style.filter = "blur(4px)";
    },
    closeModal() {
      this.$parent.$emit("close");
    },
    unBlur() {
      document.getElementById("app").style.filter = "none";
    }
  }
};
</script>
