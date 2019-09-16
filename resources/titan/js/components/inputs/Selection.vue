<template>
    <div class="form-group mx-auto position-relative">
        <select
            :class="[error != undefined ? 'is-invalid' : '']"
            :required="required"
            v-model="selection"
            :name="name">
            <option
                v-if="default_text !== null"
                :value="default_value"
                disabled >{{ default_text }}</option>
            <option
                v-for="(value, key) in options"
                :key="key"
                :value="value">{{ value }}</option>
            <slot/>
        </select>
        <i class="fal fa-angle-down"/>
        <div
            v-if="error != undefined"
            class="error-msg">
            {{ error[0] }}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        default_value: {
            type: String,
            default: null
        },
        default_text: {
            type: String,
            default: null
        },
        options: {
            type: Object,
            default: null
        },
        error: {
            type: Object,
            default: null
        },
        name: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        value: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            selection: this.value
        };
    },
    watch: {
        selection (val) {
            this.$emit('input', val);
        }
    }
};
</script>

<style scoped lang="scss">
.blue-rounded select{
    height: 30px;
    width: 245px;
    border: 1px solid rgba(0,0,0,0.1);
    background-color: #2e86de;
    color:#fff;
    border-radius: 100px;
    -webkit-appearance: none;
    padding: 4px 12px;
}
select option{
    width:100%;
    color:#fff;
    background-color:#2e86de;
}
i{
    color: #fff;
    position:absolute;
    top:10px;
    right:15px;
}
</style>
