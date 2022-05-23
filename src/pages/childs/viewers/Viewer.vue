<template>
  <q-page>
    <div>
      <a-scene
        vr-mode-ui="enterVRButton: #myEnterVRButton; enterARButton: #myEnterARButton"
      >
        <a-assets>
          <video
            id="vidToPlay"
            preload="auto"
            src="data/ressources/8.mp4"
            autoplay
            loop="true"
            segments-height="0"
            segments-width="0"
          ></video>
        </a-assets>
        <a id="myEnterVRButton" href="#">Mode VR</a>
        <a id="myEnterARButton" href="#">Mode AR</a>
        <a-videosphere src="#vidToPlay" autoplay="true"></a-videosphere>
      </a-scene>
    </div>
  </q-page>
</template>

<script>
export default {
  name: "Viewer2",
  setup() {},
};
</script>
