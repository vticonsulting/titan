<template>
    <form
        class="change-password-modal"
        action="">
        <div
            class="modal-card"
            style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    Change Password
                </p>
            </header>

            <section class="modal-card-body">
                <BField label="Current password">
                    <BInput
                        :value="email"
                        type="password"
                        placeholder="Your current password"
                        required
                    />
                </BField>

                <BField label="New password">
                    <BInput
                        :value="password"
                        type="password"
                        placeholder="Your new password"
                        required
                    />
                </BField>

                <BField label="Confirm new password">
                    <BInput
                        :value="password"
                        type="password"
                        placeholder="Confirm your new password"
                        required
                    />
                </BField>
            </section>

            <footer class="flex justify-end p-4 has-background-white-ter">
                <div class="field is-grouped is-grouped-right">
                    <p class="control">
                        <a
                            class="button is-rounded is-small is-text"
                            @click="$parent.close()"
                        >
                            Cancel
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-rounded is-small is-secondary">
                            Update
                        </a>
                    </p>
                </div>
            </footer>
        </div>
    </form>
</template>

<script>
export default {
    name: 'ChangePasswordModal',
    status: 'prototype',
    release: '1.0.0',
    props: {
        email: {
            type: String,
            default: ''
        },
        password: {
            type: String,
            default: ''
        }
    }
};
</script>
