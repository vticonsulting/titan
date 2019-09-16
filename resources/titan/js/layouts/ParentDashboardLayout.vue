<template>
  <div class="parent-dashboard-layout main-wrapper lg:flex xl:px-16">
    <div class="lg:w-2/5">
      <div class="lg:rounded-lg lg:shadow lg:border px-4 lg:px-0 lg:m-8">
        <!-- mx-4 xl:mx-auto mb-12 lg:mb-0 pb-4  -->

        <!-- <div class="item border w-32 h-32 bg-blue-500">item</div> -->

        <EventInfo :funrun-date="new Date(program.fun_run)" />
        <ParticipantCard
          v-for="participant in participants"
          :key="participant.id"
          :participant="participant"
        />
        <div class="px-8 pt-2 pb-4">
          <PledgeButton :participants="participants" />
        </div>
      </div>

      <PledgeAndShare :participants="participants" />
    </div>
    <div
      class="lg:w-3/5"
      style="order: -1"
    >
      <ParentDashboardAccordion :program="program" />
      <SponsorPromo />
    </div>
  </div>
</template>

<script>
import EventInfo from '../components/pattern/EventInfo'
import ParentDashboardAccordion from '../components/template/ParentDashboardAccordion'
import ParticipantCard from '../components/template/ParticipantCard'
import PledgeAndShare from '../components/template/PledgeAndShare'
import PledgeButton from '../components/element/PledgeButton'
import ProgramHeader from '../components/pattern/ProgramHeader'
import SponsorPromo from '../components/pattern/SponsorPromo'
import interact from 'interactjs'

export default {
  name: 'ParentDashboardLayout',
  release: '1.0.0',
  components: {
    EventInfo,
    ParentDashboardAccordion,
    ParticipantCard,
    PledgeAndShare,
    PledgeButton,
    ProgramHeader,
    SponsorPromo
  },
  props: {
    program: {
      type: Object,
      default: undefined
    }
  },
  computed: {
    participants () {
      return this.program.participants
    }
  },
  mounted () {
    interact('.item').draggable({
      onmove (event) {
        console.log(event.pageX, event.pageY)
      }
    })
  }
}
</script>
