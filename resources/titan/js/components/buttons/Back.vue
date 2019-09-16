<template>
    <div class="back-button text-left">
        <a
            href="#"
            class="text-24"
            @click="$emit('back-button', $event.target.value)"><i class="far fa-arrow-left"/></a>
    </div>
</template>

<script>
export default{
};

</script>
