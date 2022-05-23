<template>
  <router-view />
</template>
<script lang="ts">
import { defineComponent, onUnmounted, onMounted } from "vue";

export default defineComponent({
  name: "App",

  setup() {
    async function runScript() {
      const aframe = document.createElement("script");
      aframe.setAttribute("src", "https://aframe.io/releases/1.3.0/aframe.min.js");
      document.head.appendChild(aframe);
    }
    runScript();

    onMounted(() => {
      runScript();
    });
    onUnmounted(() => {
      window.location.reload();
    });
    return {};
  },
});
</script>
