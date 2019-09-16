<template>
    <div :class="['pledge-info-card flip-card', {flipped: flipped}]">
        <div class="flip-card-inner">
            <div class="flip-card-front bg-white border border-b-2 shadow-md border-grey-light rounded-lg p-2 px-4">
                <div class="flex items-center mb-2">
                    <div class="w-1/2">
                        <div class="leading-none">
                            <span class="font-semibold">
                                {{ pledge.fullname }}
                            </span><br>
                            <span class="text-xs">
                                {{ pledge.date }}
                            </span>
                        </div>
                    </div>
                    <div class="w-1/2 has-text-right">
                        <div class="flex justify-end">
                            <a
                                v-if="pledge.comment"
                                class="ml-2 flex flex-col items-center has-text-grey"
                                @click.prevent="flip"
                            >
                                <FontAwesomeIcon :icon="['far', 'comment-alt-lines']" />
                                <div class="text-xs whitespace-no-wrap">
                                    View Comment
                                </div>
                            </a>
                            <a
                                class="ml-2 flex flex-col items-center has-text-grey"
                                @click.prevent=""
                            >
                                <FontAwesomeIcon :icon="['fas', 'envelope']" />
                                <div class="text-xs">
                                    Remind
                                </div>
                            </a>
                            <a
                                class="ml-6 flex flex-col items-center has-text-grey"
                                @click.prevent=""
                            >
                                <FontAwesomeIcon :icon="['far', 'edit']" />
                                <div class="text-xs">
                                    Edit
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="text-xs w-full table table-sm mb-0">
                        <tbody>
                            <tr
                                v-for="student in pledge.students"
                                :key="student.id"
                            >
                                <td class="text-left w-100">
                                    {{ student.name }}
                                </td>
                                <td class="text-right text-nowrap">
                                    {{ student.amount }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="font-bold">
                                    <span :class="[pledge.status == 'Awaiting Confirmation' ? 'text-red' : 'text-green']">{{ pledge.status }}</span>
                                </td>
                                <td class="text-right">
                                    Total <span class="font-bold">
                                        $300 to $350
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="flip-card-back align-middle bg-white border border-b-2 shadow-md border-grey-light rounded-lg p-2 px-4">
                <div class="flex items-center mb-2">
                    <div class="w-1/2">
                        <div class="leading-none">
                            <span class="font-semibold">
                                {{ pledge.fullname }}
                            </span>
                        </div>
                    </div>
                    <div class="w-1/2 has-text-right">
                        <div class="flex justify-end">
                            <a
                                class="ml-6 flex flex-col items-center has-text-grey"
                                @click.prevent="flip"
                            >
                                <FontAwesomeIcon :icon="['far', 'times']" />
                            </a>
                        </div>
                    </div>
                </div>
                <p class="p-4 flex items-center justify-center">
                    <span class="text-center">
                        “Christopher & Elizabeth, you both are great! I’m such a proud parent.”
                    </span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pledge: {
            type: Object,
            default: () => {
                return {
                    fullname: 'Victor Tolbert'
                };
            }
        }
    },
    data () {
        return {
            flipped: false
        };
    },
    methods: {
        flip () {
            this.flipped = !this.flipped;
        }
    }
};
</script>

<style lang="scss">
.flip-card {
    background-color: transparent;
    height: 150px;
    perspective: 1000px;

    .table th,
    .table td {
        padding: 0.25rem 0;
    }
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.flip-card.flipped .flip-card-inner {
    transform: rotateY(180deg);
}

.flip-card-front,
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
}

.flip-card-back {
    transform: rotateY(180deg);
}
</style>
