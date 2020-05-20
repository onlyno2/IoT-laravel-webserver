<template>
  <CModal
    title="Device Details"
    color="primary"
    :show.sync="showDialog"
  >{{ this.deviceStore.deviceDetailsDialog.deviceId }}</CModal>
</template>

<script>
export default {
  data() {
    return {
      deviceStore: this.$store.state.deviceStore
    }
  },
  computed: {
    showDialog: {
      get: function () {
        return this.deviceStore.deviceDetailsDialog.active;
      },
      set: function () {
        this.$store.dispatch("closeDeviceDetailsDialog");
      }
    }
  }
};
</script>

<style>
</style>