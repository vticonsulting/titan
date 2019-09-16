<template>
    <div>
        <div class="form-group {">
            <label
                for="email"
                class="sr-only">{{ email_address_label }}</label>
            <input
                :class="[error ? 'is-invalid' : '','form-control mw-250px mx-auto']"
                :placeholder="email_address_label"
                type="email"
                name="email"
                required >
        </div>
        <div class="form-group">
            <label
                for="email"
                class="sr-only">{{ password_label }}</label>
            <input
                :class="[ error ? 'is-invalid': '','form-control mw-250px mx-auto']"
                :placeholder="password_label"
                type="password"
                name="password"
                required >
        </div>
        <div class="form-group">
            <label
                for="email-confirm"
                class="sr-only">{{ password_confirm_label }}</label>
            <input
                :class="[ error ? 'is-invalid': '','form-control mw-250px mx-auto']"
                :placeholder="password_confirm_label"
                type="password"
                name="password_confirmation"
                required >
        </div>
    </div>
</template>

<script>
export default{
    props: {
        email_address_label: {
            type: String,
            default: ''
        },
        password_label: {
            type: String,
            default: ''
        },
        password_confirm_label: {
            type: String,
            default: ''
        },
        error: {
            type: String,
            default: ''
        }
    }
};
</script>
