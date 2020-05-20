import axios from "axios";

const state = {
  frames: [],
  selectingFrameId: 0
}

const mutations = {
  SET_FRAME_LIST(state, frames) {
    state.frames = frames;
  },
  SET_CURRENT_FRAME(state, frameId) {
    state.selectingFrameId = frameId;
  },
  CLEAR_FRAME_LIST(state) {
    state.frames = [];
  },
  CLEAR_CURRNENT_FRAME(state) {
    state.selectingFrameId = 0;
  }
}

const actions = {
  getFrames: ({ commit }) => {
    return axios.get("/api/frames").then(response => {
      commit("SET_FRAME_LIST", response.data.data);
      commit("SET_CURRENT_FRAME", response.data.data[0].id);
    })
  }
}

export default {
  state,
  mutations,
  actions
};