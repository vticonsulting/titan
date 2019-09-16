<template>
  <div class="pledge-info card-content">
    <div class="flex items-center justify-center mb-8">
      <button
        :disabled="true"
        class="button font-semibold is-medium is-primary is-rounded"
      >
        Pay Pledges Online
      </button>
    </div>

    <div
      v-if="hasPledges"
      class="grid mb-8"
    >
      <PledgeInfoCard
        v-for="pledge in pledges"
        :key="pledge.id"
        :pledge="pledge"
      />
    </div>

    <div
      v-else
      class="mx-auto max-w-sm mb-8"
    >
      <figure class="image">
        <img src="/assets/dashboard/images/empty-state.svg">
      </figure>
    </div>
</div>
</template>

<script>
import PledgeInfoCard from './PledgeInfoCard'

export default {
  name: 'PledgeInfo',
  status: 'prototype',
  release: '1.0.0',
  components: {
    PledgeInfoCard
  },
  props: {
    program: {
      type: Object,
      default: null
    }
  },
  data () {
    return {
      isFlipped: false,
      pledges: [
        {
          id: 1,
          fullname: 'Sue Jones',
          date: 'Feb 9',
          status: 'Awaiting Confirmation',
          comment: null,
          students: [
            {
              name: 'Christopher',
              amount: '$5 per lap'
            },
            {
              name: 'Elizabeth',
              amount: '$5 per lap'
            }
          ]
        },
        {
          id: 2,
          fullname: 'Walter Jones',
          date: 'Feb 9',
          status: null,
          comment:
            'Christopher & Elizabeth, you both are great! I’m such a proud parent.',
          students: [
            {
              name: 'Christopher',
              amount: '$20'
            },
            {
              name: 'Elizabeth',
              amount: '$20'
            }
          ]
        },
        {
          id: 3,
          fullname: 'Mac Williams',
          date: 'Feb 9',
          status: null,
          comment: null,
          students: [
            {
              name: 'Christopher',
              amount: '$2 per lap'
            },
            {
              name: 'Elizabeth',
              amount: '$2 per lap'
            }
          ]
        },
        {
          id: 4,
          fullname: 'Mike Jones',
          date: 'Feb 9',
          status: 'Payment Scheduled',
          comment: null,
          students: [
            {
              name: 'Christopher',
              amount: '$2 per lap'
            },
            {
              name: 'Elizabeth',
              amount: '$2 per lap'
            }
          ]
        },
        {
          id: 5,
          fullname: 'Justin Thomas',
          date: 'Feb 9',
          status: 'Paid Online',
          comment: null,
          students: [
            {
              name: 'Christopher',
              amount: '$5'
            },
            {
              name: 'Elizabeth',
              amount: '$5           '
            }
          ]
        }
      ]
    }
  },
  computed: {
    hasPledges () {
      return this.pledges.length > 0
    }
  }
}
</script>

<style lang="scss" scoped>
.pledge-info .grid {
  display: grid;
  grid-gap: 1rem;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));

  @media (min-width: 576px) {
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
  }
}
</style>
