<template>
  <q-page class="AFJpage">
    <div class="AFJcontainer AFJcontainer__fxs overflow-hidden q-mx-auto q-pt-lg">
      <div class="flex justify-between q-pt-lg">
        <div style="width: 30%">
          <img src="data/thumb/couteau.jpeg" alt="" />
        </div>

        <div style="width: 70%">
          <div>
            <q-chip color="gray" text-color="white" class="flex justify-center">
              <q-avatar>
                <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <span class="tex text-weight-bold q-pt-sm">Par Vincent Asani</span>
            </q-chip>
            <q-rating
              name="quality"
              v-model="note"
              max="5"
              size="1.5em"
              color="yellow"
              icon="star_border"
              icon-selected="star"
              no-dimming
            />
          </div>
          <h1 class="text-h4 text-weight-bold">
            Voyez le couteau de Mansa Kanku Moussa en 3D
          </h1>

          <p class="text-h6">Une vue en 3D du couteau de Mansa Kanku Moussa</p>

          <p class="text-gray">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam atque
            accusantium ipsum deserunt! Cum vitae error nostrum pariatur fugiat nam quasi
            distinctio nobis atque. Consequatur accusantium eius magnam nulla
            reprehenderit!
          </p>

          <div id="share">
            <!-- facebook -->{{ title }}
            <a
              class="facebook"
              href="https://www.facebook.com/share.php?u=http://localhost:8080/?#/viewer/3d_object&title="
              target="blank"
              ><i class="fa fa-facebook"></i
            ></a>

            <!-- twitter -->
            <a
              class="twitter"
              href="https://twitter.com/intent/tweet?status=http://localhost:8080/?#/viewer/3d_object"
              target="blank"
              ><i class="fa fa-twitter"></i
            ></a>

            <!-- google plus -->
            <a
              class="googleplus"
              href="https://plus.google.com/share?url=http://localhost:8080/?#/viewer/3d_object"
              target="blank"
              ><i class="fa fa-google-plus"></i
            ></a>

            <!-- linkedin -->
            <a
              class="linkedin"
              href="https://www.linkedin.com/shareArticle?mini=true&url=http://localhost:8080/?#/viewer/3d_object"
              target="blank"
              ><i class="fa fa-linkedin"></i
            ></a>

            <!-- pinterest -->
            <a
              class="pinterest"
              href="https://pinterest.com/pin/create/bookmarklet/?url=http://localhost:8080/?#/viewer/3d_object"
              target="blank"
              ><i class="fa fa-pinterest-p"></i
            ></a>
          </div>

          <div>
            <q-media-player
              type="audio"
              background-color="black"
              radius="1rem"
              :autoplay="true"
              :show-big-play-button="true"
              :sources="audio.source"
            >
              <template v-if="overlay" v-slot:overlay>
                <div>
                  <img
                    src="quasar-logo.png"
                    style="width: 30vw; max-width: 50px; opacity: 0.25"
                  />
                </div>
              </template>
            </q-media-player>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "viewer",
  setup() {
    var note = ref();
    return {
      note: 3,
      audio: {
        sources: [
          {
            src:
              "https://raw.githubusercontent.com/quasarframework/quasar-ui-qmediaplayer/dev/demo/public/media/Scott_Holmes_-_04_-_Upbeat_Party.mp3",
            type: "audio/mp3",
          },
        ],
      },
    };
  },
});
</script>
