<template>
  <div class="school-goals-and-stats card-content">
    <div class="md:flex md:flex-row-reverse mb-4 md:border-b-2">
      <div class="md:w-1/2 mb-4 text-center">
        <img
          class="responsive"
          src="/assets/dashboard/images/school_goal_carousel.jpg"
        >
        <p>Pagination</p>
      </div>

      <div class="md:w-1/2 flex items-center justify-between mb-4 pr-6">
        <div class="w-2/3 p-4">
          <h2 class="is-paddingless is-marginless text-xl">
            Total Goal Amount
          </h2>
          <h3 class="is-paddingless is-marginless text-3xl font-semibold">
            $50,000
          </h3>
          <p class="text-lg mb-6">
            We are raising funds for STEM Certification and Computers &amp; iPads!
          </p>
        </div>
        <div class="p-4">
          <RingChart />
        </div>
      </div>
    </div>
    <div class="md:flex md:border-b-2 pb-4">
      <div class="md:w-1/2 p-4 md:border-r-2">
        <h2 class="text-xl font-bold">
          Team Pledge-O-Meter
        </h2>
        <p class="text-sm mb-4">
          $30 flat donation = $1 per reading challenge (PRC)
        </p>

        <div class="p-0">
          <div class="mb-4">
            <div class="team-meter mb-4">
              <p class="is-marginless">
                Silva - 2nd Grade
              </p>
              <ProgressMeter
                :width="50"
                color="secondary"
              />
            </div>
            <div class="team-meter">
              <p class="is-marginless">
                Joseph - Kindergarten
              </p>
              <ProgressMeter
                :width="75"
                color="secondary"
              />
            </div>
            <p class="text-center mb-8">
              <a
                class="font-bold"
                href="#"
              >
                View more
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="md:w-1/2 p-4">
        <h2 class="text-xl font-bold">
          Pledges by State
        </h2>
        <img
          class="block mx-auto"
          src="/assets/dashboard/images/us.svg"
        >
        <div class="text-center">
          <p class="mb-4">
            States: 5
          </p>

          <select>
            <option>School States</option>
          </select>
          <select>
            <option>Team States</option>
          </select>
          <select>
            <option>My States</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SchoolGoalAndStats',
  status: 'prototype',
  release: '1.0.0',
  props: {
    program: {
      type: Object,
      default: null
    }
  }
}
</script>
