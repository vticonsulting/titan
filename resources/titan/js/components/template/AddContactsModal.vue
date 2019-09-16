<template>
    <div class="m-4 overflow-hidden rounded-xl">
        <div class="card bg-blue w-full">
            <header
                v-if="!isSending"
                class="card-header bg-blue text-white border-b-0 p-4 shadow-none"
            >
                <p class="flex justify-between items-center text-center modal-card-title text-white">
                    <span style="width: 24px; height: 48px;" />
                    <span class="flex-1 text-center text-2xl font-bold">Add Contact</span>
                    <a
                        href="#"
                        class="text-white self-start"
                        style="width: 24px; height: 48px;"
                        @click.prevent="close"
                    >
                        <span class="icon">
                            <FontAwesomeIcon
                                :icon="['fas', 'times']"
                                size="xs"
                            />
                        </span>
                    </a>
                </p>
            </header>
            <div
                v-if="isSending"
                class="card-content py-16 sm:px-32 text-white text-center">
                <SendEnvelope />
                <p class="font-bold text-xl">Email sent to:</p>
                <p class="font-semibold">3 Contact(s)</p>
            </div>
            <div
                v-else
                class="card-content animated fadeIn animated-slow text-white bg-blue">
                <div class="sm:w-64 mx-auto">
                    <BField>
                        <BInput
                            v-model="contact.first_name"
                            placeholder="First Name"
                            expanded
                        />
                    </BField>
                    <BField>
                        <BInput
                            v-model="contact.last_name"
                            placeholder="Last Name"
                            expanded
                        />
                    </BField>
                    <BField>
                        <BInput
                            v-model="contact.email_address"
                            placeholder="Email Address"
                            expanded
                        />
                    </BField>
                </div>
            </div>
            <div
                v-if="!isSending"
                class="card-footer border-t-0"
            >
                <div class="card-footer-item flex-col mb-4">
                    <button
                        class="px-16 py-2 bg-white text-secondary rounded-full inline-block font-bold shadow"
                        @click="sendEmail"
                    >
                        Send Email
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddContactsButtons from './AddContactsButtons';

export default {
    name: 'EmailTemplatesModal',
    components: {
        AddContactsButtons
    },
    data () {
        return {
            isSending: false,
            contact: {
                firstName: 'Victor',
                lastName: 'Tolbert',
                emailAddress: 'victor.tolbert@gmail.com'
            },
            templates: [
                {
                    id: 1,
                    isOpen: false
                },
                {
                    id: 2,
                    isOpen: false
                },
                {
                    id: 3,
                    isOpen: false
                }
            ]
        };
    },
    methods: {
        sendEmail () {
            this.isSending = true;
            setTimeout(() => {
                this.close();
            }, 3000);
        },
        close () {
            this.$emit('close');
            document.getElementById('app').style.filter = 'none';
        }
    }
};
</script>
