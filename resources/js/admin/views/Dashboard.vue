<template>
  <div>
    <WidgetsDropdown />
    <CRow v-for="(chunkedDevices, index) in chunked" :key="index">
      <CCol :md="6" v-for="(device, i) in chunkedDevices" :key="i">
        <CCard>
          <CCardBody>
            <CRow>
              <CCol>
                <h4 class="card-title mb-0">DeviceId: {{ device.id }}</h4>
                <div class="small text-muted">
                  Location: x:{{ device.xaxis }} - y:{{ device.yaxis }}
                </div>
              </CCol>
            </CRow>
            <CChartLineExample
              class="mt-2 device-chart"
              :deviceId="device.id"
            ></CChartLineExample>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </div>
</template>

<script>
import CChartLineExample from "./charts/CChartLineExample";
import WidgetsDropdown from "./widgets/WidgetsDropdown";
import { mapState } from "vuex";

export default {
  name: "Dashboard",
  components: {
    WidgetsDropdown,
    CChartLineExample
  },
  data() {
    return {};
  },
  computed: {
    ...mapState({
      devices: state => state.deviceStore.devices
    }),
    chunked() {
      let result = [];
      for (let i = 0; i < this.devices.length; i = i + 2) {
        result.push(this.devices.slice(i, i + 2));
      }
      return result;
    }
  },
  created() {
    this.$store.dispatch("getDevices");
  }
};
</script>

<style lang="scss">
.device-chart {
  height: 250px;
}
</style>
