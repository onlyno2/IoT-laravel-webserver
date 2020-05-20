<template>
  <div>
    <WidgetsDropdown />
    <CRow v-for="(chunkedDevices, index) in chunked" :key="index">
      <CCol :md="6" v-for="(device, i) in chunkedDevices" :key="i">
        <CCard>
          <CCardBody>
            <CRow>
              <CCol :md="10" style="padding-right: 0px">
                <h4 class="card-title mb-0">DeviceId: {{ device.id }}</h4>
                <div class="small text-muted">Location: x:{{ device.xaxis }} - y:{{ device.yaxis }}</div>
              </CCol>
              <CCol :md="2">
                <div class="btn-group">
                  <button
                    type="button"
                    class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <CIcon name="cil-settings" />
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button
                      class="dropdown-item"
                      type="button"
                      @click="openDeviceDetail(device.id)"
                    >Device Detail</button>
                  </div>
                </div>
              </CCol>
            </CRow>
            <CChartLineExample class="mt-2 device-chart" :deviceId="device.id"></CChartLineExample>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
    <DeviceDetail></DeviceDetail>
  </div>
</template>

<script>
import CChartLineExample from "./charts/CChartLineExample";
import WidgetsDropdown from "./widgets/WidgetsDropdown";
import DeviceDetail from "./components/DeviceDetail";
import { mapState } from "vuex";

export default {
  name: "Dashboard",
  components: {
    WidgetsDropdown,
    CChartLineExample,
    DeviceDetail
  },
  data() {
    return {
      detailModal: false,
      deviceId: "",
      frameId: 0
    };
  },
  computed: {
    ...mapState({
      devices: state => state.deviceStore.devices,
      frames: state => state.frameStore.frames,
      currentFrame: state => state.frameStore.selectingFrameId
    }),
    chunked() {
      let result = [];
      for (let i = 0; i < this.devices.length; i = i + 2) {
        result.push(this.devices.slice(i, i + 2));
      }
      return result;
    }
  },
  methods: {
    openDeviceDetail(id) {
      this.$store.dispatch("openDeviceDetailsDialog", id);
    }
  },
  watch: {
    currentFrame: function(newVal, oldVal) {
      if(newVal !== 0) {
        this.$store.dispatch("getDevices", newVal);
      }
    }
  },
  created() {
    this.$store.dispatch("getFrames");
  }
};
</script>

<style lang="scss">
.device-chart {
  height: 250px;
}
</style>
