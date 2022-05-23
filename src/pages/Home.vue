<template>
  <q-page class="AFJpage">
    <div class="AFJpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="AFJfont--bold AFJfs--28">
          Bienvenu sur <span class="AFJline">AfrikaJungle <span></span></span>
        </h1>
        <div class="q-mb-lg q-pt-xs">
          <p class="AFJcolor--g">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus at sint
            reiciendis magni, pariatur a ullam unde odio assumenda sit tempore voluptatum
          </p>
        </div>
        <div class="row justify-center">
          <div class="row justify-center">
            <div class="q-mr-md">
              <q-input
                filled
                v-model="textSearch"
                placeholder="Rechercher un contenu"
                class="flex flex-sm-center"
              >
                <template v-slot:append>
                  <q-icon name="close" @click="textSearch = ''" class="cursor-pointer" />
                  <q-icon name="eva-search" size="18px" />
                </template>
              </q-input>
            </div>

            <div class="flex flex-center AFJcomponent--control">
              <q-item
                clickable
                class="flex flex-center AFJcolor--g q-mr-md q-ml-md"
                to="#"
              >
                <q-icon name="eva-grid-outline" color="primary" style="font-size: 20px">
                </q-icon>
              </q-item>
              <q-item clickable class="flex flex-center AFJcolor--g" to="#">
                <q-icon name="eva-list-outline" style="font-size: 20px"> </q-icon>
              </q-item>
            </div>
          </div>
        </div>
      </div>

      <div class="AFJpage__header__img">
        <div class="l">
          <img src="others/14.png" alt="" />
        </div>
        <div class="r">
          <img src="others/13.png" alt="" />
        </div>
      </div>
    </div>

    <div class="AFJcontainer AFJcontainer__fxs overflow-hidden">
      <div class="full-width AFJcontainer q-mr-auto q-ml-auto flex flex-center">
        <div class="full-width">
          <h2 class="AFJfont--bold AFJfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-bookmark-outline"
                class="AFJcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Pour vous
              <span class="AFJfont--medium AFJfs--14 AFJcolor--g q-ml-md">
                <span> (Recommandations </span>
                <span class="AFJfont--bold AFJcolor--p"> 3 contenus </span>
                <span> ) </span>
              </span>
            </div>
          </h2>
          <div class="AFJgrid--flex-">
            <swiper
              :slidesPerView="2"
              :spaceBetween="40"
              :slidesPerGroup="1"
              :loop="true"
              :loopFillGroupWithBlank="true"
              :pagination="true"
              :navigation="true"
              class="mySwiper"
            >
              <swiper-slide
                v-for="data in vrDate"
                :key="data"
                v-bind="data"
                class="bg-white"
              >
                <q-card class="AFJcard--rec bg-white">
                  <q-card-section class="header">
                    <img
                      :src="data.thumbnail"
                      class="AFJskeleton--img"
                      height="205"
                      width="150"
                      alt=""
                    />
                  </q-card-section>
                  <q-card-section class="text-left full-width q-mt-auto q-mb-auto">
                    <div class="flex row justify-between">
                      <div>
                        <router-link
                          :to="'/' + data.link + '/' + data.type"
                          class="text-subtitle1 AFJ--a text-weight-bolder"
                          >{{ data.name }}</router-link
                        >
                      </div>
                      <div class="q-ml-md"></div>
                    </div>
                    <div class="q-mt-lg colorPicker">
                      <p>{{ data.desc }}</p>
                    </div>

                    <div class="row justify-start q-mt-lg">
                      <q-rating
                        name="quality"
                        v-model="data.note"
                        max="5"
                        size="1.5em"
                        color="yellow"
                        icon="star_border"
                        icon-selected="star"
                        no-dimming
                      />
                      <div class="flex justify-center q-mt-sm q-ml-lg">
                        <span>{{ data.views }} </span>
                        <span class="q-ml-sm text-grey">vues</span>
                      </div>
                    </div>
                  </q-card-section>
                </q-card>
              </swiper-slide>

              <swiper-slide>
                <q-card class="AFJcard--rec">
                  <q-card-section class="header">
                    <q-skeleton
                      class="AFJskeleton--img"
                      height="205px"
                      width="150px"
                      square
                    />
                  </q-card-section>
                  <q-card-section class="text-left full-width q-mt-auto q-mb-auto">
                    <div class="flex row justify-between">
                      <q-skeleton type="text" width="70%" square />
                      <q-skeleton type="text" class="q-ml-md" width="20%" square />
                    </div>
                    <div class="q-mt-lg">
                      <q-skeleton
                        animation="pulse"
                        height="20px"
                        class="q-mt-md"
                        width="100%"
                        square
                      />
                      <q-skeleton
                        animation="pulse"
                        height="10px"
                        class="q-mt-xs"
                        width="100%"
                        square
                      />
                      <q-skeleton
                        animation="pulse"
                        height="10px"
                        class="q-mt-xs"
                        width="100%"
                        square
                      />
                    </div>

                    <div class="row justify-start q-mt-lg">
                      <q-skeleton type="text" class="q-mr-md" width="20%" square />
                      <q-skeleton type="text" class="q-mr-md" width="20%" square />
                      <q-skeleton type="text" class="q-mr-md" width="20%" square />
                    </div>
                  </q-card-section>
                </q-card>
              </swiper-slide>
            </swiper>
          </div>
        </div>
      </div>
    </div>

    <div class="AFJcontainer AFJcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div v-if="sessionExists()" class="full-width">
          <h2 class="AFJfont--bold AFJfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-clock-outline"
                class="AFJcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Lus récement
              <span class="AFJfont--medium AFJfs--14 AFJcolor--g q-ml-md">
                <span> (Par vous </span>
                <span class="AFJfont--bold AFJcolor--p"> 2 contenus </span>
                <span> ) </span>
              </span>
            </div>
          </h2>

          <div
            class="fit row wrap justify-start items-start content-start q-gutter-lg AFJfull-width"
          >
            <q-card class="AFJcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="AFJskeleton--img"
                  height="100px"
                  width="100px"
                  square
                />
              </q-card-section>
              <q-card-section class="text-left full-width q-mt-auto q-mb-auto">
                <div class="flex row justify-between">
                  <q-skeleton type="text" width="70%" square />
                  <q-skeleton type="text" class="q-ml-xs" width="20%" square />
                </div>
                <div>
                  <q-skeleton
                    animation="pulse"
                    height="20px"
                    class="q-mt-xs"
                    width="100%"
                    square
                  />
                </div>

                <div class="row justify-start q-mt-xs">
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                </div>
              </q-card-section>
            </q-card>

            <q-card class="AFJcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="AFJskeleton--img"
                  height="100px"
                  width="100px"
                  square
                />
              </q-card-section>
              <q-card-section class="text-left full-width q-mt-auto q-mb-auto">
                <div class="flex row justify-between">
                  <q-skeleton type="text" width="70%" square />
                  <q-skeleton type="text" class="q-ml-xs" width="20%" square />
                </div>
                <div>
                  <q-skeleton
                    animation="pulse"
                    height="20px"
                    class="q-mt-xs"
                    width="100%"
                    square
                  />
                </div>

                <div class="row justify-start q-mt-xs">
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                  <q-skeleton type="text" class="q-mr-md" width="20%" square />
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>
      </div>
    </div>

    <div class="AFJcontainer AFJcontainer__fxs q-mt-lg flex flex-center overflow-hidden">
      <div class="row justify-center">
        <div class="q-mt-lg">
          <q-btn
            color="white"
            icon="eva-refresh-outline"
            text-color="primary"
            class="AFJcolor--white AFJbtn q-mr-lg full-width"
            label="Voir plus"
          />
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, reactive, ref, onMounted } from "vue";
import userData from "local-storage";
import { useRouter } from "vue-router";
import { api } from "boot/axios";
import { Swiper, SwiperSlide } from "swiper/vue";
import SwiperCore, { Lazy, Pagination, Navigation } from "swiper/core";
SwiperCore.use([Lazy, Pagination, Navigation]);

import "swiper/swiper.scss";
import JsonData from "../data/jsonVrData.json";

export default defineComponent({
  name: "homme",
  components: {
    Swiper,
    SwiperSlide,
  },

  setup() {
    var vrDate = ref(JsonData);
    console.log(vrDate.value);

    const router = useRouter();
    var userID = ref(null);
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (sessionExists()) {
      userID.value = userData.get(2000)[0].v1;
    } else {
      router.push("/auth");
    }
    const callLog = () => {
      router.push("/auth");
    };
    var booksFav = ref(reactive([]));
    var favCatsFromServer = ref(reactive([]));
    var tab = ref("");

    const nameSlide = 0;
    return {
      nameSlide,
      slide: ref(1),
      favCatsFromServer,
      //METHODES
      sessionExists,
      callLog,
      tab,
      textSearch: "",

      vrDate,
    };
    onMounted(() => {});
  },
});
</script>
