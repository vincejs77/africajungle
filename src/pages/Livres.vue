<template>
  <q-page class="bXYpage">
    <div class="bXYpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="bXYfont--bold bXYfs--28">
          Parcourir les <span class="bXYline">Livres <span></span></span>
        </h1>
        <div class="q-mb-lg q-pt-xs flex flex-center full-width">
          <p class="bXYcolor--g">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus at sint
            reiciendis magni, pariatur a ullam unde odio assumenda sit tempore voluptatum
          </p>
        </div>
        <div class="row justify-center">
          <div class="q-mr-md">
            <q-input
              filled
              v-model="ph"
              placeholder="Rechercher un Livre"
              class="flex flex-sm-center"
            >
              <template v-slot:append>
                <q-icon name="close" @click="text = ''" class="cursor-pointer" />
                <q-icon name="eva-search" size="18px" />
              </template>
            </q-input>
          </div>
          <div>
            <q-btn-dropdown
              text-color="white"
              class="bXYbtn bXYdropdown q-mr-lg full-width"
              color="primary"
              icon="eva-funnel-outline"
            >
              <div class="bXYdropdown--filter">
                <q-tree
                  class="col-12 col-sm-6"
                  :nodes="categories"
                  node-key="label"
                  tick-strategy="leaf"
                  v-model:selected="selected"
                  v-model:ticked="ticked"
                  v-model:expanded="expanded"
                />
                <div class="q-chip-container- q-mt-md">
                  <q-chip
                    v-for="tick in livres"
                    :key="`ticked-${tick}`"
                    size="md"
                    icon="eva-hash-outline"
                  >
                    {{ tick }}
                  </q-chip>
                </div>

                <div class="flex flex-center q-mt-lg">
                  <q-btn
                    color="primary"
                    icon="eva-search-outline"
                    text-color="white"
                    class="bXYcolor--white q-mr-lg bXYbtn full-width"
                    label="Valider"
                  />
                  <q-btn
                    color="white"
                    icon="eva-refresh-outline"
                    text-color="primary"
                    class="bXYcolor--white q-mr-lg q-mt-md bXYbtn full-width"
                    label="Formater"
                  />
                </div>
              </div>
            </q-btn-dropdown>
          </div>
          <div class="flex flex-center bXYcomponent--control">
            <q-item clickable class="flex flex-center bXYcolor--g q-mr-md q-ml-md" to="#">
              <q-icon name="eva-grid-outline" color="primary" style="font-size: 20px">
              </q-icon>
            </q-item>
            <q-item clickable class="flex flex-center bXYcolor--g" to="#">
              <q-icon name="eva-list-outline" style="font-size: 20px"> </q-icon>
            </q-item>
          </div>
        </div>
      </div>

      <div class="bXYpage__header__img">
        <div class="l">
          <img src="banners/png/pablita-631.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-908.png" alt="" />
        </div>
      </div>
    </div>

    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-options-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Catégories Favorites
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Par vous </span>
                <span class="bXYfont--bold bXYcolor--p"> 259 livres </span>
                <span> ) </span>
              </span>
            </div>
            <div>
              <q-tabs
                v-model="tab"
                dense
                class="bXYtab--simple bXYtab--simple-r q-gutter-lg"
              >
                <q-tab v-for="c in myCat" v-bind:key="c" :name="c.toLowerCase()" :label="c" />
                <!-- <q-tab name="science fiction" label="Sciences fiction" />
                <q-tab name="mathematiques" label="Mathématique" />
                <q-tab name="informatique" label="Informatique" />
                <q-tab name="environnement" label="Environnement" /> -->
              </q-tabs>
            </div>
          </h2>

          <div
            class="row wrap justify-start items-start content-start q-gutter-lg bXYfull-width"
          >
            <q-card
              v-for="(livre, index) in livres"
              :key="livre"
              :style="tab === 'toutes' || tab === livre.cat ? '':'display:none'"
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
                        addBookFav(livres.indexOf(livre), livre.id, livre.fav))
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
                            livres.indexOf(livre),
                            livre.id,
                            parseInt(livre.vues) + 1,
                          addToMyread(livre.id)
                          ))
                        : callLog()
                    "
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
          </div>

          <div class="bXYbox__control row justify-between flex-center">
            <div class="bXYfont--medium bXYfs--14 bXYcolor--g">
              <span>Vue de </span>
              <span class="bXYfont--bold bXYcolor--p"> 09 livres </span>
              <span> sur un total de </span>
              <span class="bXYfont--bold bXYcolor--p">234</span>
            </div>

            <q-pagination
              v-model="currentPagination"
              :max="5"
              direction-links
              color="dark"
              active-color="primary"
            />
          </div>
        </div>
      </div>
    </div>

    <q-dialog v-model="dialog" :position="position">
      <div class="flex flex-center relative-position">
        <div class="bXYdialog--viewer">
          <div class="bXYpdf__header flex flex-center row justify-between">
            <div class="q-gutter-sm">
              <q-chip>
                <q-avatar>
                  <img src="others/Avatar 1-Dark.svg" width="10px" />
                </q-avatar>
                <span class="text-caption bXYcolor--g1 q-ml-sm">Auteur : </span>
                <span class="q-ml-sm"> Vincent Asani</span>
              </q-chip>
            </div>
            <div class="q-gutter-sm flex flex-center">
              <q-chip>
                <q-avatar color="positive" text-color="white">14</q-avatar>
                Vues
              </q-chip>
              <q-rating size="18px" v-model="starslivre" :max="5" color="warning" />
              <span class="text-caption bXYcolor--g1 q-ml-sm">4.2 (551)</span>
            </div>
          </div>
          <WebViewer :initialDoc="activeBook.file" />
        </div>
      </div>
    </q-dialog>
  </q-page>
</template>

<script>
// import livresMethode from "../scripts/mehodes/livres"
import WebViewer from "./childs/livres/WebViewer.vue";
import { api } from "boot/axios";
import { ref, reactive, defineComponent, onMounted, onBeforeMount } from "vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
const livres = ref(reactive([]));

export default defineComponent({
  name: "Livres",
  components: {
    WebViewer,
  },

  setup: () => {
    let activeBook = ref(null);
    const router = useRouter();
    var userID = ref(null)
    const sessionExists = () => {
      return userData.get(2000);
    };
    const callLog = () => {
      router.push("/auth");
    };
    if (sessionExists()) {
      userID = userData.get(2000)[0].v1
    }
    const dialog = ref(false);
    var tab = ref("")
    let selectedAnnee = ref(null);
    let annee = reactive([]);
    const position = ref("bottom");
    var myCat = ref(reactive([]))
        const getMyCat = () => {
        api.post('userFile.php', {
          code: 2,
          myid: userID
        }).then((r) => {
          myCat.value = r.data
          if (myCat.value.length > 0) {
            tab.value = myCat.value[0].toLowerCase()
          }

        }).catch((e) => {
          alert(e)
        })
      }
    const searchLivre = () => {
      api
        .post("livres.php", {
          code: 5,
          title: "",
          first_year: selectedAnnee.value.first_year,
          second_year: selectedAnnee.value.second_year,
        })
        .then((r) => {
          // livres.value = r.data;
          // alert(r.data)
        })
        .catch((res) => {
          alert("serveur non disponible");
        });
    };
    const addBookVue = (index, livre, vues) => {
      api
        .post("/livres.php", {
          code: 2,
          vues: vues,
          livre: livre,
        })
        .then((r) => {
          livres.value[index].vues = vues;
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    const addBookFav = (index, livre, favs) => {
      api
        .post("/livres.php", {
          code: 3,
          favs: favs,
          livre: livre,
        })
        .then((r) => {
          livres.value[index].inFav = true;
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    const addToMyread = (livre) => {
      // alert(userID)
      api
        .post("/livres.php", {
          code: 6,
          myid: userID,
          livre: livre,
        })
        .then((r) => {
          // alert(r.data)
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    }
    if (sessionExists()) {
       getMyCat()
    }
    onMounted(() => {
      async function setLivres() {
        api
          .post("/livres.php", {
            code: 1,
          })
          .then((response) => {
            livres.value = response.data;
          })
          .catch((response) => {
            console.log("serveur non dis");
          });
        [{}, {}];
      }
      async function getInterval() {
        api
          .post("livres.php", {
            code: 4,
          })
          .then((r) => {
            annee[0] = r.data;
            if (annee[0].length > 0) {
              selectedAnnee.value = annee[0][0];
            }
            // alert(r.data)
          })
          .catch((res) => {
            alert("serveur non disponibleeeeeeeeeeeeeeeeeeeeeeeee");
          });
      }
      // getInterval();
      setLivres();
      console.log(livres);
    });

    return {
      tab,

      //Appel des fonctions
      livres,
      addBookVue,
      addBookFav,
      searchLivre,
      sessionExists,
      callLog,
      addToMyread,
      //Data
      text: "",
      show: "",
      userID,
      starslivre: 5,
      selectedAnnee,
      annee,
      myCat,
      currentPagination: 1,
      selected: ref("Pleasant surroundings"),
      ticked: ref(["Quality ingredients", "Good table presentation"]),
      expanded: ref([
        "Satisfied customers",
        "Good service (disabled node)",
        "Pleasant surroundings",
      ]),
      categories: [
        {
          label: "Satisfied customers",
          children: [
            {
              label: "Good food",
              children: [{ label: "Quality ingredients" }, { label: "Good recipe" }],
            },

            {
              label: "Pleasant surroundings",
              children: [
                { label: "Happy atmosphere" },
                { label: "Good table presentation" },
                { label: "Pleasing decor" },
              ],
            },
            {
              label: "Categorie de merde",
              children: [
                { label: "Happy atmosphere z" },
                { label: "Good table presentation z" },
                { label: "Pleasing decor f" },
              ],
            },
          ],
        },
      ],

      // livres

      activeBook,

      dialog,
      position,

      open(pos) {
        position.value = pos;
        dialog.value = true;
      },
    };
  },
});
</script>
