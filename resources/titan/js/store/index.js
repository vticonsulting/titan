import Vue from 'vue';
import Vuex from 'vuex';
import * as user from './modules/user';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    user
  },
  state: {
    lang: Object,
    user_type: String,
    default_user_image: String,
    activeTab: 0,
    s3Bucket: '',
    avatarPath: ''
  },
  mutations: {
    SET_LANG(state, lang) {
      state.lang = lang;
    },
    SET_USER(state, user) {
      // Restructure the user for the dashboard page
      let participants = user.participants;
      delete user.participants;
      let programs = [];
      // sort the participants by program;
      _.each(participants, participant => {
        let programId = participant.participant_info.classroom.group.program.id;
        let program = programs.find(program => program.id === programId);
        if (program === undefined || !participant.participant_info.family_pledging_enabled) {
          program = participant.participant_info.classroom.group.program;
          program.participants = [];
          programs.push(program);
        }
        delete participant.participant_info.classroom.group.program;
        program.participants.push(participant);
      });

      // Sort Alphabetically

      _.each(programs, program => {
        _.sortBy(program.participants, 'first_name');
      });
      _.sortBy(programs, 'name');

      user.programs = programs;
      state.User = user;
    },
    SET_USER_TYPE(state, type) {
      state.user_type = type;
    },
    SET_DEFAULT_USER_IMAGE(state, url) {
      state.default_user_image = url;
    },
    SET_USER_PHOTO(state, url) {
      let user = state.User;
      user.participants[user.participants.length - 1].photo_url = url;
      this.commit('set_user', user);
    },
    setS3Bucket(state, bucket) {
      state.s3Bucket = bucket;
    },
    setAvatarPath(state, avatarPath) {
      state.avatarPath = avatarPath;
    }
  },
  getters: {
    avatarPath: state => {
      return 'https://' + state.s3Bucket + '.s3.amazonaws.com/' + state.avatarPath;
    }
  }
});

export default store;
