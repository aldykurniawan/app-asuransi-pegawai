<template>
  <div></div>
</template>

<script>
import { onMounted, ref } from 'vue';
import 'leaflet.locatecontrol/dist/L.Control.Locate.css';
import L from 'leaflet';
import 'leaflet.locatecontrol';

export default {
  props: {
    map: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const locateControl = ref(null);

    onMounted(() => {
      // Initialize the locate control
      locateControl.value = L.control
        .locate({
          position: 'topright',
          drawCircle: false,
          follow: false,
          setView: true,
          keepCurrentZoomLevel: true,
          stopFollowingOnDrag: true,
          remainActive: false,
          markerStyle: {
            opacity: 1,
            zIndexOffset: 1000,
          },
          circleStyle: {
            fillColor: '#0000ff',
            fillOpacity: 0.1,
            stroke: true,
            color: '#0000ff',
            weight: 2,
            opacity: 0.5,
          },
          icon: 'fa fa-location-arrow',
          metric: false,
          strings: {
            title: 'Show me where I am',
            popup: 'You are within {distance} {unit} from this point',
            outsideMapBoundsMsg: 'You seem located outside the boundaries of the map',
          },
          locateOptions: {
            maxZoom: 18,
            watch: true,
            enableHighAccuracy: true,
            maximumAge: 10000,
            timeout: 10000,
          },
        })
        .addTo(props.map);
    });

    return {
      locateControl,
    };
  },
  beforeUnmount() {
    if (this.locateControl) {
      this.locateControl.stop();
    }
  },
};
</script>
