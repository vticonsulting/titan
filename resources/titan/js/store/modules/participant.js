import Classroom from './classroom';
import School from './school';

export const state = {
    first_name: {
        type: String,
        default: ''
    },
    last_name: {
        type: String,
        default: ''
    },
    school: {
        type: School,
        default: null
    },
    classroom: {
        type: Classroom,
        default: null
    },
    photo_url: {
        type: String,
        default: undefined
    }
};

export const mutations = {
    SET_USER_PHOTO (state, url) {
        state.photo_url = url;
    }
};
