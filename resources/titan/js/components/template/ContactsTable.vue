<template>
  <section>
    <div class="contacts-table px-4 pb-4 text-xs sm:text-sm md:text-base">
      <div class="border border-transparent pl-3 pb-1">
        <BCheckbox
          v-if="contacts.length"
          :value="newAllSelected"
          type="is-secondary"
          @change.native="toggleSelectAll(true)"
        >
          <span
            class="inline-block pl-2 sm:pl-3"
          >{{ newAllSelected ? 'Unselect All' : 'Select All' }}</span>
        </BCheckbox>
      </div>

      <table class="table is-fullwidth border">
        <!-- Show contacts header, if there are any -->
        <thead v-if="contacts.length">
          <tr class="bg-secondary text-white">
            <th colspan="2">Contact</th>
            <th>Status</th>
            <th>
              <FontAwesomeIcon
                v-if="!isEditing"
                :icon="['far', 'user-edit']"
                class="cursor-pointer"
                @click="isEditing = true"
              />
              <button
                v-else
                class="button is-secondary is-inverted is-small"
                @click="isEditing = false"
              >
                <span>Close</span>
                <span class="icon">
                  <FontAwesomeIcon :icon="['fas', 'times']"/>
                </span>
              </button>
            </th>
          </tr>
        </thead>

        <!-- Show the contacts, if we have them  -->
        <tbody v-if="contacts.length">
          <tr v-for="(contact, index) in contacts" :key="index">
            <td class="align-middle">
              <BCheckbox
                v-if="contact.previousSponsor"
                :value="contact.isChecked"
                type="is-secondary"
                class="custom"
                @change.native="selectContact(index, contact.isChecked)"
              />
            </td>
            <td class="w-full">
              <div class="flex-1 sm:flex items-center justify-between">
                <div class="flex-1">
                  {{ contact.name }}
                  <br>
                  {{ contact.email }}
                </div>
                <div
                  v-if="contact.previousSponsor"
                  class="ital,ic font-semibold has-text-secondary sm:pr-10"
                >Previous Sponsor</div>
              </div>
            </td>
            <td>{{ contact.status }}</td>
            <td class="text-center align-middle">
              <FontAwesomeIcon
                v-if="isEditing"
                :icon="['fas', 'trash-alt']"
                @click="removeContact(contact)"
              />
            </td>
          </tr>
        </tbody>

        <!-- Empty State (No Contacts) -->
        <tbody v-else>
          <tr>
            <td>
              <div class="p-8 text-center text-secondary">
                <FontAwesomeIcon :icon="['fas', 'user-plus']" size="2x"/>

                <p>
                  Add your contracts to get started
                  <br>and let the
                  <b>Pledges</b> start rolling in!
                </p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
import RemoveContactModal from "./RemoveContactModal";

export default {
  name: "ContactsTable",
  props: {
    contacts: {
      type: Array,
      default: function() {
        return [];
      }
    },
    allSelected: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      isEditing: false,
      checkedRows: [],
      selectBalanceValue: 0,
      selectBalanceInitialValue: 0,
      respectAllSelected: true,
      newAllSelected: true
    };
  },
  computed: {
    previousSponsors() {
      return this.contacts.filter(contact => contact.previousSponsor);
    },
    checked() {
      return this.contacts.filter(contact => contact.isChecked);
    }
  },
  created() {
    this.newAllSelected = this.allSelected;
    this.selectBalanceValue = this.contacts.filter(
      contact => contact.isChecked
    ).length;
    this.selectBalanceInitialValue = this.contacts.filter(
      contact => contact.isChecked
    ).length;
  },
  methods: {
    toggleSelectAll(toggleSelected) {
      this.newAllSelected = !this.newAllSelected;
      for (let i in this.contacts) {
        this.contacts[i].isChecked = this.newAllSelected;
      }
      if (toggleSelected) {
        if (this.newAllSelected) {
          this.selectBalanceValue = this.selectBalanceInitialValue;
        } else {
          this.selectBalanceValue = 0;
        }
      }
    },
    removeContact(contact) {
      this.$modal.open({
        parent: this,
        component: RemoveContactModal,
        hasModalCard: true,
        width: 320,
        onCancel: this.unBlur
      });
      document.getElementById("app").style.filter = "blur(4px)";
      this.isEditing = false;
    },
    selectContact(index, isSelected) {
      this.contacts[index].isChecked = !isSelected;
      if (!isSelected) {
        this.setBalance(1);
      } else {
        this.setBalance(-1);
      }

      if (this.selectBalanceValue === 0) {
        this.toggleSelectAll();
      } else if (this.selectBalanceValue === this.selectBalanceInitialValue) {
        this.toggleSelectAll();
      }
    },
    setBalance(increment) {
      this.selectBalanceValue = this.selectBalanceValue + increment;
    },
    unBlur() {
      document.getElementById("app").style.filter = "none";
    }
  }
};
</script>

<style>
.table thead td,
.table thead th {
  color: #ffffff;
}
.table td,
.table th {
  vertical-align: middle;
}
.table thead th {
  height: 4em;
}
.b-checkbox.checkbox.custom .control-label {
  padding-left: 0;
}
td.checkbox-cell label.is-disabled {
  display: none;
}
</style>
