<template>
  <section
    class="section is-paddingless min-h-screen"
    @close="close"
  >
    <div>
      <main>
        <div class="mx-auto max-w-3xl -mt-4">
          <div class="p-8 bg-grey-lightest md:bg-white text-lg md:text-2xl mb-8">
            <p class="mb-8">
              Add your contacts to automatically send a few emails asking for a pledge.
              <a
                class="font-semibold"
                @click="viewEmailTemplates"
              >View emails here!</a>
            </p>

            <p>
              Send your own email using our
              <br class="sm:hidden">
              <a
                class="font-semibold"
                hred="#"
              >pre-written template.</a>
            </p>
          </div>

          <AddContactsButtons />

          <div
            v-if="contacts.length"
            class="pb-5"
          >
            <div class="text-center">
              <button
                :disabled="!allSelectedTest"
                class="w-64 button px-10 font-semibold is-rounded is-secondary shadow"
                @click="emailPreviousSponsors"
              >
                Email Previous Sponsors
              </button>
            </div>
          </div>

          <ContactsTable
            :all-selected="allSelectedTest"
            :contacts="contacts"
            @hook:updated="doSomething"
            @toggleSelectAll="allSelected = !allSelected"
          />
        </div>
      </main>
    </div>
  </section>
</template>

<script>
import EmailTemplatesModal from '../components/template/EmailTemplatesModal'
import EmailPreviousSponsorsModal from '../components/template/EmailPreviousSponsorsModal'
import AddContactsButtons from '../components/template/AddContactsButtons'
import ContactsTable from '../components/template/ContactsTable'

export default {
  name: 'EasyEmailer',
  status: 'prototype',
  release: '1.0.0',
  components: {
    AddContactsButtons,
    ContactsTable
  },
  data () {
    return {
      active: false,
      allSelected: true,
      isEditing: false,
      hasPreviousSponsors: true,
      selectedContacts: [],
      contacts: [
        {
          name: 'John Smith',
          email: 'jsmith@yahoo.com',
          previousSponsor: true,
          isChecked: true,
          status: 'Ready'
        },
        {
          name: 'Tricia Brigham',
          email: 'tbrigham@yahoo.com',
          previousSponsor: true,
          isChecked: true,
          status: 'Ready'
        },
        {
          name: 'Scott Bryan',
          email: 'sbryan@yahoo.com',
          previousSponsor: false,
          isChecked: false,
          status: 'Emailed'
        },
        {
          name: 'Jonathan Chambers',
          email: 'jchambers@yahoo.com',
          previousSponsor: false,
          isChecked: false,
          status: 'Paused'
        }
      ]
    }
  },
  computed: {
    tooltipOptions () {
      return {
        classes: ['info'],
        content:
          'Removing a contact will remove them from this list for the current email campaign.<br><br> Unsubscribed means a sponsor has decided to stop receiving these emails.',
        placement: 'left-start',
        trigger: 'hover click focus'
      }
    },
    hasContacts () {
      return this.contacts.length > 0
    },
    previousSponsors () {
      return this.contacts.filter(contact => contact.previousSponsor)
    },
    allSelectedTest () {
      return !!this.allSelected
    }
  },
  mounted () {
    this.selectedContacts = this.previousSponsors
  },
  methods: {
    doSomething () {
      console.log('contacts table lifecycle updated')
    },
    viewEmailTemplates () {
      this.$modal.open({
        parent: this,
        component: EmailTemplatesModal,
        hasModalCard: true,
        onCancel: this.unBlur
      })
      document.getElementById('app').style.filter = 'blur(4px)'
    },
    emailPreviousSponsors () {
      this.$modal.open({
        parent: this,
        component: EmailPreviousSponsorsModal,
        hasModalCard: true,
        onCancel: this.unBlur
      })
      document.getElementById('app').style.filter = 'blur(4px)'
    },
    close () {
      alert('alert')
    },
    unBlur () {
      document.getElementById('app').style.filter = 'none'
    }
  }
}
</script>
