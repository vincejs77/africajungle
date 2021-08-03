<template>
  <q-card class="bXYdialog--viewer bXYdialog--skeleton">
    <q-card-section class="text-left full-width q-mt-auto q-mb-auto">
      <div class="row justify-between full-width">
        <q-skeleton type="text" class="q-mr-md" height="36px" width="30%" square />
        <q-skeleton type="text" class="q-mr-md" height="36px" width="25%" square />
        <q-skeleton type="text" class="q-mr-md" height="36px" width="30%" square />
      </div>
      <q-card-section class="flex flex-center justify-center full-height">
        <q-skeleton class="bXYskeleton--img" height="100%" width="80%" square />
      </q-card-section>

      <div class="row justify-center flex flex-center q-mt-md">
        <q-skeleton type="text" class="q-mr-md" height="40px" width="20%" square />
      </div>
    </q-card-section>
  </q-card>
  <div id="webviewer" class="full-width" ref="viewer"></div>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import WebViewer from "@pdftron/webviewer";

export default defineComponent({
  name: "WebViewer",
  props: { initialDoc: { type: String } },
  setup(props) {
    const viewer = ref(null);
    onMounted(() => {
      const path = "/webviewer";
      WebViewer({ path, initialDoc: props.initialDoc }, viewer.value).then((instance) => {
        instance.setLanguage("fr");

        instance.disableElements(["printButton"]);
        instance.disableElements(["downloadButton"]);
        instance.disableElements(["highlightToolGroupButton"]);
        instance.disableElements(["underlineToolGroupButton"]);
        instance.disableElements(["strikeoutToolGroupButton"]);
        instance.disableElements(["squigglyToolGroupButton"]);
        instance.disableElements(["stickyToolGroupButton"]);
        instance.disableElements(["freeTextToolGroupButton"]);
        instance.disableElements(["shapeToolGroupButton"]);
        instance.disableElements(["freeHandToolGroupButton"]);
        instance.disableElements(["eraserToolButton"]);
        instance.docViewer.on("documentLoaded", () => {});
      });
    });

    return {
      viewer,
    };
  },
});
</script>

<style>
#webviewer {
  height: 800px;
  width: 700px;
}
</style>
