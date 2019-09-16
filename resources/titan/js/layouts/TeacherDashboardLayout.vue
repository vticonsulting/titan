<template>
  <div class="teacher-dashboard-layout main-wrapper">
    <EventInfo :funrun-date="new Date(program.fun_run)"/>
    <ParticipantCard
      v-for="participant in participants"
      :key="participant.id"
      :participant="participant"
    />
    <PledgeAndShare :participants="participants"/>
    <TeacherDashboardAccordion :program="program"/>
    <SponsorPromo/>
  </div>
</template>

<script>
import EventInfo from "../components/pattern/EventInfo";
import ParticipantCard from "../components/template/ParticipantCard";
import PledgeAndShare from "../components/template/PledgeAndShare";
import ProgramHeader from "../components/pattern/ProgramHeader";
import SponsorPromo from "../components/pattern/SponsorPromo";
import TeacherDashboardAccordion from "../components/template/TeacherDashboardAccordion";

export default {
  name: "TeacherDashboardLayout",
  release: "1.0.0",
  components: {
    EventInfo,
    ParticipantCard,
    PledgeAndShare,
    ProgramHeader,
    SponsorPromo,
    TeacherDashboardAccordion
  },
  props: {
    program: {
      type: Object,
      default: undefined
    }
  },
  computed: {
    participants() {
      return this.program.participants;
    }
  }
};
</script>
