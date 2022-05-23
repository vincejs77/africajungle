<template>
  <div class="checkSreen">
    <router-view />
  </div>
  <div class="-checkSreen q-pt-lg q-pl-lg q-pr-lg q-pb-lg">
    <br /><br /><br />
    <h1 class="text-h4">Ooups</h1>
    <p class="text-h6">
      Pour le moment, <span class="color text-primary">AfricaJungle</span> n'est pas
      adapté à cet écran
    </p>
    <p class="text-h6 text-grey">
      At the moment, <span class="color text-primary">AfricaJungle</span> is not suitable
      for this screen
    </p>
    <q-btn
      class="AFJbtn--small"
      icon="eva-github"
      text-color="primary"
      label="Code Sources"
      target="_blank"
      type="a"
      href="https://github.com/vincejs77/africajungle"
    ></q-btn>
  </div>
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
