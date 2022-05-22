<template>
  <div class="fullscreen text-center q-pa-md flex flex-center">
    <div>
      <div class="AFJcontainer text-center">
        <img src="banners/png/pablita-695.png" style="width: 300px" />
        <h1 class="AFJfont--bold AFJfs--28">Error404 Page non trouvé</h1>
        <div class="AFJfs--16 AFJcolor--g flex flex-center">
          <p style="width: 400px">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic asperiores
            voluptas ullam dolores consequatur? Vel
          </p>
        </div>
        <div class="q- q-mt-lg">
          <q-btn
            color="primary"
            icon="eva-chevron-left-outline"
            text-color="white"
            class="AFJcolor--white"
            label="Retourner vers le site"
            to="/"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import userData from "local-storage";

export default defineComponent({
  name: "Error404",
});
</script>
