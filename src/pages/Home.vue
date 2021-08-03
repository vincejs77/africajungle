<template>
  <q-page class="bXYpage">
    <div class="bXYpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="bXYfont--bold bXYfs--28">
          De la connaissance, des <span class="bXYline">Livres <span></span></span>
        </h1>
        <div class="q-mb-lg q-pt-xs">
          <p class="bXYcolor--g">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus at sint
            reiciendis magni, pariatur a ullam unde odio assumenda sit tempore voluptatum
          </p>
        </div>
        <div class="row justify-center">
          <div class="q-mr-md">
            <q-btn
              color="primary"
              icon="eva-book-outline"
              text-color="white"
              class="bXYcolor--white bXYbtn q-mr-lg full-width"
              label="C'est parti"
            />
          </div>
          <div>
            <q-btn
              color="white"
              icon="eva-arrow-ios-forward-outline"
              text-color="primary"
              class="bXYcolor--white bXYbtn q-mr-lg full-width"
              label="En savoir plus"
            />
          </div>
        </div>
      </div>

      <div class="bXYpage__header__img">
        <div class="l">
          <img src="banners/png/3.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-book-app-delivery.png" alt="" />
        </div>
      </div>
    </div>

    <div v-if="sessionExists()" class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-clock-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Lus Récement
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Par vous </span>
                <span class="bXYfont--bold bXYcolor--p"> 259 livres </span>
                <span> ) </span>
              </span>
            </div>
            <div style="margin-right: 2rem !important">
              <q-item to="#" clickable class="bXYlink--simple flex flex-center">
                Voir plus
                <q-icon
                  name="eva-arrow-ios-downward-outline"
                  class="q-ml-xs"
                  size="xs"
                ></q-icon>
              </q-item>
            </div>
          </h2>

          <div
            v-if="sessionExists()"
            class="fit row wrap justify-start items-start content-start q-gutter-lg"
          >
            <q-card
              v-for="(livre, index) in booksRecent"
              :key="livre"
              :name="index + 1"
              class="bXYcard--hist"
            >
              <q-card-section class="header">
                <div class="img">
                  <img :src="livre.img" />
                </div>
                <q-btn
                  color="primary"
                  text-color="white"
                  icon="eva-heart-outline"
                  class="absolute mark"
                  v-if="livre.inFav"
                />
                <q-btn
                  color="white"
                  @click="
                    sessionExists()
                      ? ((livre.fav = parseInt(livre.fav) + 1),
                        addBookFav(booksRecent.indexOf(livre), livre.id, livre.fav))
                      : callLog()
                  "
                  text-color="primary"
                  icon="eva-heart-outline"
                  class="absolute mark"
                  v-else
                >
                </q-btn>
              </q-card-section>
              <q-card-section class="text-left full-width q-mt-auto q-mb-auto text">
                <div class="starts row justify-between no-wrap">
                  <div>
                    <q-rating
                      size="15px"
                      v-model="livre.stars"
                      :max="5"
                      color="warning"
                    />
                  </div>
                  <div>
                    <span class="text-caption bXYcolor--g q-ml-sm">4.2 (551)</span>
                  </div>
                </div>

                <div class="title q-pt-xs">
                  <q-item
                    clickable
                    @click="
                      sessionExists()
                        ? ((activeBook = livre),
                          open('bottom'),
                          addBookVue(
                            booksRecent.indexOf(livre),
                            livre.id,
                            parseInt(livre.vues) + 1
                          ))
                        : callLog()
                    "
                    :to="sessionExists() ? '/livres/webviewer' : ''"
                    :link="sessionExists() ? '/livres/webviewer' : ''"
                  >
                    {{ livre.title }}
                  </q-item>
                </div>

                <div class="tags text-left row justify-start q-mt-xs flex-sm no-wrap">
                  <q-chip size="sm">
                    {{ livre.cat }}
                  </q-chip>
                  <q-chip
                    v-for="sousCat in livre.sousCats"
                    :key="`souscat-${sousCat}`"
                    size="sm"
                  >
                    {{ sousCat }}
                  </q-chip>
                </div>
              </q-card-section>
            </q-card>

            <q-card class="bXYcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="bXYskeleton--img"
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

            <q-card class="bXYcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="bXYskeleton--img"
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
        <div class="bXYbox--container--size-1--custom">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-bell-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Notifications
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Pour vous </span>
                <span> ) </span>
              </span>
            </div>
          </h2>

          <div class="bXYbox bXYbox--container--size-1--custom">
            <div class="bXYnotification">
              <q-timeline color="primary">
                <q-timeline-entry v-for="n in booksNoty" v-bind:key="n">
                  <template v-slot:title> {{ n.label }}</template>
                  <template v-slot:subtitle> {{ n.date }} </template>
                  <div>{{ n.value }}</div>
                </q-timeline-entry>

                <!-- <q-timeline-entry>
                  <template v-slot:title> Event Title </template>
                  <template v-slot:subtitle> February 21, 1986 </template>
                  <div>Lorem ipsum dolor sit amet, consectetur adipisicing</div>
                </q-timeline-entry>

                <q-timeline-entry>
                  <template v-slot:title> Event Title </template>
                  <template v-slot:subtitle> February 22, 1986 </template>

                  <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</div>
                </q-timeline-entry> -->
              </q-timeline>

              <div class="flex flex-center">
                <q-item to="#" clickable class="bXYlink--simple flex flex-center">
                  Voir plus
                  <q-icon
                    name="eva-arrow-ios-downward-outline"
                    class="q-ml-xs"
                    size="xs"
                  ></q-icon>
                </q-item>
              </div>
            </div>
          </div>

          <div class="flex flex-center">
            <q-btn
              color="white"
              icon="eva-trash-outline"
              text-color="primary"
              class="bXYcolor--white bXYbtn full-width q-mt-lg"
              label="Effacer toutes les nofications"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="full-width bXYcontainer q-mr-auto q-ml-auto flex flex-center">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-bookmark-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Pour vous
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Recommandations </span>
                <span class="bXYfont--bold bXYcolor--p"> 259 livres </span>
                <span> ) </span>
              </span>
            </div>
          </h2>
          <div class="bXYgrid--flex-">
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
                v-for="(livre, index) in booksForMe"
                :key="livre"
                :name="index + 1"
              >
                <q-card class="bXYcard--rec">
                  <q-card-section class="header">
                    <div class="img">
                      <img :src="livre.img" />
                    </div>
                    <q-btn
                      color="primary"
                      text-color="white"
                      icon="eva-heart-outline"
                      class="absolute mark"
                      v-if="livre.inFav"
                    />
                    <q-btn
                      color="white"
                      @click="
                        sessionExists()
                          ? ((livre.fav = parseInt(livre.fav) + 1),
                            addBookFav(booksForMe.indexOf(livre), livre.id, livre.fav))
                          : callLog()
                      "
                      text-color="primary"
                      icon="eva-heart-outline"
                      class="absolute mark"
                      v-else
                    >
                    </q-btn>
                  </q-card-section>
                  <q-card-section class="text-left full-width q-mt-auto q-mb-auto text">
                    <div class="starts row justify-between no-wrap">
                      <div>
                        <q-rating
                          size="16px"
                          v-model="livre.stars"
                          :max="5"
                          color="warning"
                        />
                      </div>
                      <div>
                        <span class="text-caption bXYcolor--g q-ml-sm">4.2 (551)</span>
                      </div>
                    </div>

                    <div class="title q-pt-xs">
                      <q-item
                        clickable
                        @click="
                          sessionExists()
                            ? ((activeBook = livre),
                              open('bottom'),
                              addBookVue(
                                booksForMe.indexOf(livre),
                                livre.id,
                                parseInt(livre.vues) + 1
                              ))
                            : callLog()
                        "
                        :to="sessionExists() ? '/livres/webviewer' : ''"
                        :link="sessionExists() ? '/livres/webviewer' : ''"
                      >
                        {{ livre.title }}
                      </q-item>
                    </div>

                    <div class="desc bXYcolor--g">{{ livre.desc }}</div>
                    <div class="tags text-left row justify-start q-mt-md flex-sm no-wrap">
                      <q-chip size="sm">
                        {{ livre.cat }}
                      </q-chip>
                      <q-chip
                        v-for="sousCat in livre.sousCats"
                        :key="`souscat-${sousCat}`"
                        size="sm"
                      >
                        {{ sousCat }}
                      </q-chip>
                    </div>

                    <div class="row justify-between footer">
                      <div class="r"></div>
                    </div>
                  </q-card-section>
                </q-card>
              </swiper-slide>
              <swiper-slide>
                <q-card class="bXYcard--rec">
                  <q-card-section class="header">
                    <q-skeleton
                      class="bXYskeleton--img"
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

    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div v-if="sessionExists()" class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-clock-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Catégories Favorites
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Par vous </span>
                <span class="bXYfont--bold bXYcolor--p">
                  {{ booksFav.length }} livres
                </span>
                <span> ) </span>
              </span>
            </div>
            <div>
              <q-tabs
                v-model="tab"
                dense
                class="bXYtab--simple bXYtab--simple-r q-gutter-lg"
              >
                <q-tab
                  v-for="f in favCatsFromServer"
                  v-bind:key="f"
                  :name="f.toLowerCase()"
                  :label="f"
                />
                <!-- <q-tab name="science fiction" label="Sciences fiction" />
                <q-tab name="mathematiques" label="Mathématique" />
                <q-tab name="informatique" label="Informatique" />
                <q-tab name="environnement" label="Environnement" /> -->
              </q-tabs>
            </div>
          </h2>

          <div
            class="fit row wrap justify-start items-start content-start q-gutter-lg bXYfull-width"
          >
            <q-card
              v-for="(livre, index) in booksFav"
              :key="livre"
              :name="index + 1"
              class="bXYcard--other"
            >
              <q-card-section class="header">
                <div class="img">
                  <img :src="livre.img" />
                </div>
                <q-btn
                  color="primary"
                  text-color="white"
                  icon="eva-heart-outline"
                  class="absolute mark"
                  v-if="livre.inFav"
                />
                <q-btn
                  color="white"
                  @click="
                    sessionExists()
                      ? ((livre.fav = parseInt(livre.fav) + 1),
                        addBookFav(booksFav.indexOf(livre), livre.id, livre.fav))
                      : callLog()
                  "
                  text-color="primary"
                  icon="eva-heart-outline"
                  class="absolute mark"
                  v-else
                >
                </q-btn>
              </q-card-section>
              <q-card-section class="text-left full-width q-mt-auto q-mb-auto text">
                <div class="starts row justify-between no-wrap">
                  <div>
                    <q-rating
                      size="15px"
                      v-model="livre.stars"
                      :max="5"
                      color="warning"
                    />
                  </div>
                  <div>
                    <span class="text-caption bXYcolor--g q-ml-sm">4.2 (551)</span>
                  </div>
                </div>

                <div class="title q-pt-xs">
                  <q-item
                    clickable
                    @click="
                      sessionExists()
                        ? ((activeBook = livre),
                          open('bottom'),
                          addBookVue(
                            booksFav.indexOf(livre),
                            livre.id,
                            parseInt(livre.vues) + 1
                          ))
                        : callLog()
                    "
                    :to="sessionExists() ? '/livres/webviewer' : ''"
                    :link="sessionExists() ? '/livres/webviewer' : ''"
                  >
                    {{ livre.title }}
                  </q-item>
                </div>

                <div class="tags text-left row justify-start q-mt-xs flex-sm no-wrap">
                  <q-chip size="sm">
                    {{ livre.cat }}
                  </q-chip>
                  <q-chip
                    v-for="sousCat in livre.sousCats"
                    :key="`souscat-${sousCat}`"
                    size="sm"
                  >
                    {{ sousCat }}
                  </q-chip>
                </div>
              </q-card-section>
            </q-card>

            <q-card class="bXYcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="bXYskeleton--img"
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

            <q-card class="bXYcard--hist">
              <q-card-section class="header">
                <q-skeleton
                  class="bXYskeleton--img"
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

    <div class="bXYcontainer bXYcontainer__fxs q-mt-lg flex flex-center overflow-hidden">
      <div class="row justify-center">
        <div class="q-mt-lg">
          <q-btn
            color="white"
            icon="eva-refresh-outline"
            text-color="primary"
            class="bXYcolor--white bXYbtn q-mr-lg full-width"
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
import { useRouter, useRoute } from "vue-router";
import { api } from "boot/axios";
import { Swiper, SwiperSlide } from "swiper/vue";
import SwiperCore, { Lazy, Pagination, Navigation } from "swiper/core";
SwiperCore.use([Lazy, Pagination, Navigation]);

import "swiper/swiper.scss";

export default defineComponent({
  name: "homme",
  components: {
    Swiper,
    SwiperSlide,
  },
  setup() {
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
    var booksForMe = ref(reactive([]));
    var booksRecent = ref(reactive([]));
    var booksFav = ref(reactive([]));
    var booksNoty = reactive([]);
    var favCatsFromServer = ref(reactive([]));
    var tab = ref("");
    const getMyCat = () => {
      api
        .post("userFile.php", {
          code: 2,
          myid: userID.value,
        })
        .then((r) => {
          // alert(r.data)
          favCatsFromServer.value = r.data;
          console.log("AAAA1", favCatsFromServer.value[0]);
          if (favCatsFromServer.value.length > 0) {
            tab.value = favCatsFromServer.value[0].toLowerCase();
          }
        })
        .catch((e) => {
          alert(e);
        });
    };
    const setLivres = () => {
      api
        .post("/livres.php", {
          code: 1,
        })
        .then((r) => {
          booksForMe.value = r.data;
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    setLivres();
    const getMyFavLivre = () => {
      console.log("AAAAAAAAAAAAAAA", favCatsFromServer.value[0]);
      api
        .post("/livres.php", {
          code: 8,
          allMyFav: ["Sous categorie", "Je suis une catégorie", "Sombrero"],
        })
        .then((r) => {
          // alert(r.data)
          booksFav.value = r.data;
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    const setRecentLivres = () => {
      api
        .post("/livres.php", {
          code: 7,
          myid: userID.value,
        })
        .then((r) => {
          // alert(r.data)
          booksRecent.value = r.data;
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    if (sessionExists()) {
      getMyCat();
      getMyFavLivre();
      setRecentLivres();
    }
    booksNoty.push({
      label: "Livre ajouté : Sciences Fiction",
      value: "Lorem ipsum dolor sit amet, consect",
      date: "February 22, 1986",
    });
    booksNoty.push({
      label: "Livre ajouté : Sciences Fiction",
      value: "Lorem ipsum dolor sit amet, consect",
      date: "February 22, 1986",
    });
    booksNoty.push({
      label: "Livre ajouté : Sciences Fiction",
      value: "Lorem ipsum dolor sit amet, consect",
      date: "February 22, 1986",
    });
    const nameSlide = 0;
    return {
      nameSlide,
      slide: ref(1),
      booksForMe,
      booksRecent,
      booksFav,
      booksNoty,
      favCatsFromServer,
      //METHODES
      sessionExists,
      callLog,

      tab,
    };
    onMounted(() => {});
  },
});
</script>
