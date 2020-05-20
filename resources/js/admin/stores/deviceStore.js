import axios from "axios";

const state = {
  devices: [],
  deviceDetailsDialog: {
    deviceId: '',
    active: false
  }
};

const mutations = {
  SET_DEVICES(state, devices) {
    state.devices = devices;
  },
  CLEAR_DEVICE(state) {
    state.devices = [];
  },
  OPEN_DEVICE_DETAILS_DIALOG(state, deviceId) {
    state.deviceDetailsDialog.active = true;
    state.deviceDetailsDialog.deviceId = deviceId;
  },
  CLOSE_DEVICE_DETAILS_DIALOG(state) {
    state.deviceDetailsDialog.active = false;
    state.deviceDetailsDialog.deviceId = '';
  }
};

const actions = {
  getDevices: ({ commit }, frameId) => {
    let data = {
      frame_id: frameId
    };

    return axios
      .get("/api/devices", { params: data })
      .then(response => {
        commit("SET_DEVICES", response.data.data);
      });
  },
  clearDevices: ({ commit }) => {
    commit("CLEAR_DEVICES");
  },
  openDeviceDetailsDialog: ({ commit }, deviceId) => {
    commit("OPEN_DEVICE_DETAILS_DIALOG", deviceId);
  },
  closeDeviceDetailsDialog: ({ commit }) => {
    commit("CLOSE_DEVICE_DETAILS_DIALOG");
  }
};

export default {
  state,
  mutations,
  actions
};
