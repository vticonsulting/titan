<template>
    <div
        class="parent-dashboard-accordion lg:border-l-0 lg:shadow-none"
        style="border-left: 0">
        <BCollapse
            v-for="(item, index) in items"
            :key="index"
            :open="item.isOpen"
            class="card lg:shadow-none lg:border-l-0"
        >
            <div
                slot="trigger"
                slot-scope="props"
                class="flex justify-between py-4 px-4 md:px-8 shadow-none"
            >
                <p class="text-2xl font-medium">
                    <span>{{ item.title }}</span>
                    <span v-if="pledgeCount && item.name == 'PledgeInfo'"> ({{ pledgeCount }})</span>
                </p>
                <a class="card-header-icon text-grey-dark">
                    <FontAwesomeIcon :icon="props.open ? 'chevron-up' : 'chevron-down'" />
                </a>
            </div>
            <component
                :is="item.name"
                :program="program" />
        </BCollapse>
    </div>
</template>

<script>
import ProgramOverview from './ProgramOverview';
import SchoolGoalAndStats from './SchoolGoalAndStats';
import HowToGetPledges from './HowToGetPledges';
import StudentStarVideo from './StudentStarVideo';
import PledgeInfo from './PledgeInfo';
import BusinessLeaderboard from './BusinessLeaderboard';

export default {
    name: 'ParentDashboardAccordion',
    status: 'prototype',
    version: '1.0.0',
    components: {
        ProgramOverview,
        SchoolGoalAndStats,
        HowToGetPledges,
        StudentStarVideo,
        PledgeInfo,
        BusinessLeaderboard
    },
    props: {
        program: {
            type: Object,
            default: null
        }
    },
    data () {
        return {
            pledgeCount: 5,
            items: [
                {
                    name: 'ProgramOverview',
                    title: 'Program Overview',
                    isOpen: this.isDesktop()
                },
                {
                    name: 'SchoolGoalAndStats',
                    title: 'School Goal and Stats',
                    isOpen: this.isDesktop()
                },
                {
                    name: 'HowToGetPledges',
                    title: 'How To Get Pledges',
                    isOpen: this.isDesktop()
                },
                {
                    name: 'StudentStarVideo',
                    title: this.studentStarVideoTitle(),
                    isOpen: this.isDesktop()
                },
                {
                    name: 'PledgeInfo',
                    title: 'Pledges',
                    isOpen: this.isDesktop()
                },
                {
                    name: 'BusinessLeaderboard',
                    title: 'Business Leaderboard',
                    isOpen: this.isDesktop()
                }
            ]
        };
    },
    methods: {
        isDesktop () {
            return window.matchMedia('(min-width: 769px)').matches;
        },
        studentStarVideoTitle () {
            return this.program.participants
                .find(participant => participant.profile.image_name !== null)
                ? 'Share Student Star Video'
                : 'Create Student Star Video';
        }
    }
};
</script>
