import axios from "axios";
import cookie from "vue-cookies";

var token = cookie.get("Token");

const state = {
  devices: []
};

const mutations = {
  SET_DEVICES(state, devices) {
    state.devices = devices;
  },
  CLEAR_DEVICE(state) {
    state.devices = [];
  }
};

const actions = {
  getDevices: ({ commit }) => {
    return axios
      .get("/api/devices", {
        headers: {
          Authorization: `${token}`
        }
      })
      .then(response => {
        commit("SET_DEVICES", response.data.data);
      });
  },
  clearDevices: ({ commit }) => {
    commit("CLEAR_DEVICES");
  }
};

export default {
  state,
  mutations,
  actions
};
