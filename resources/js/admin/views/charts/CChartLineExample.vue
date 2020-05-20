<template>
  <CChartLine
    :datasets="defaultDatasets"
    :options="defaultOptions"
    :labels="labels"
  />
</template>

<script>
import { CChartLine } from "@coreui/vue-chartjs";

export default {
  name: "CChartLineExample",
  components: { CChartLine },
  props: ["deviceId"],
  data() {
    return {
      labels: [],
      defaultDatasets: [
        {
          label: "Temperature",
          backgroundColor: "rgb(228,102,81,0.9)",
          data: []
        },
        {
          label: "Humidity",
          backgroundColor: "rgb(0,216,255,0.9)",
          data: []
        }
      ]
    };
  },
  computed: {
    defaultOptions() {
      return {
        maintainAspectRatio: false,
        scales: {
          xAxes: [
            {
              gridLines: {
                drawOnChartArea: false
              }
            }
          ],
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                maxTicksLimit: 5,
                stepSize: Math.ceil(100 / 20),
                max: 100
              },
              gridLines: {
                display: true
              }
            }
          ]
        },
        elements: {
          point: {
            radius: 0,
            hitRadius: 10,
            hoverRadius: 4,
            hoverBorderWidth: 3
          }
        }
      };
    }
  },
  created() {
    this.$mqtt.subscribe(`data/${this.deviceId}/sensorData`);
    this.$mqtt.on("message", (topic, message) => {
      const updateTopic = topic.split("/")[1];
      console.log(message.toString);
      if (updateTopic === this.deviceId) {
        let currentTime = new Date();
        const data = JSON.parse(message.toString());
        currentTime.setSeconds(0, 0);
        this.labels.push(
          `${currentTime.getFullYear()}-${currentTime.getMonth()}-${currentTime.getDay()} ${currentTime.getHours()}:${currentTime.getMinutes()}`
        );
        this.defaultDatasets[0].data.push(data.temperature);
        this.defaultDatasets[1].data.push(data.humidity);
        if (this.defaultDatasets[0].data.length > 5)
          this.defaultDatasets[0].data.shift();
        if (this.defaultDatasets[1].data.length > 5)
          this.defaultDatasets[1].data.shift();
        if (this.labels.length > 5) this.labels.shift();
      }
    });
  },
  beforeMount() {
    this.$http
      .get(`/api/devices/${this.deviceId}/data`)
      .then(res => {
        const data = res.data.data.values;
        const displayData =
          data.length > 5 ? data.slice(data.length - 5) : data;
        const date = res.data.data.date;
        displayData.forEach(element => {
          let currentTime = new Date(element.time * 60000 + date);
          this.labels.push(
            `${currentTime.getFullYear()}-${currentTime.getMonth()}-${currentTime.getDay()} ${currentTime.getHours()}:${currentTime.getMinutes()}`
          );
          this.defaultDatasets[0].data.push(element.temperature);
          this.defaultDatasets[1].data.push(element.humidity);
        });
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>
