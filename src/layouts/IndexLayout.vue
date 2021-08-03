<template>
  <q-layout view="hHh Lpr lff">
    <q-drawer
      v-model="drawer"
      show-if-above
      @click.capture="drawerClick"
      :breakpoint="500"
      bordered
      class="bg-white bXYdrawer"
      :width="80"
    >
      <q-item class="logo">
        <span> <img src="logo.png" /> </span>
      </q-item>
      <q-scroll-area overflow-hidden class="fit relative-position">
        <q-list>
          <EssentialLink v-for="link in essentialLinks" :key="link.title" v-bind="link" />
        </q-list>
      </q-scroll-area>
      <q-list class="absolute-bottom q-pb-md">
        <q-item
          v-if="sessionExists()"
          clickable
          @click="logOut()"
          tag="a"
          class="bottom flex flex-center"
        >
          <q-icon name="logout" size="24px">
            <q-tooltip
              anchor="center right"
              transition-show="scale"
              transition-hide="scale"
              self="center left"
              class="bg-dark bXYtooltip bXYtooltip--r"
              content-style="font-size: 12px"
            >
              Deconnexion
            </q-tooltip>
          </q-icon>
        </q-item>
        <q-item v-if="sessionExists()" class="bottom flex flex-center">
          <q-avatar
            size="35px"
            font-size="16px"
            circle
            color="primary"
            text-color="white"
          >
            <span class="x bXYfont--bold">{{ sessionInfos[0].v3[0] }}</span>
          </q-avatar>
        </q-item>
      </q-list>
    </q-drawer>
    <q-page-container class="bXYbg--w">
      <q-header class="full-width">
        <q-toolbar class="text-dark bg-white full-width">
          <div class="flex flex-center full-width">
            <!-- <q-item>
            <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
          </q-item> -->
            <q-toolbar-title class="flex flex-sm-center">
              <q-btn
                color="primary"
                icon="eva-funnel-outline"
                text-color="white"
                class="bXYcolor--white q-mr-lg bXYbtn"
                label="Filter"
              />

              <q-input
                filled
                v-model="ph"
                placeholder="Rechercher sur bexpressBook"
                class="flex flex-sm-center"
              >
                <template v-slot:append>
                  <q-icon name="close" @click="text = ''" class="cursor-pointer" />
                  <q-icon name="eva-search" size="18px" />
                </template>
              </q-input>
              <div class="heade__button q-ml-lg">
                <q-item
                  clickable
                  class="flex flex-center relative bXYcolor--g q-mr-xl"
                  to="#"
                >
                  <q-icon name="eva-clock-outline" style="font-size: 16px"> </q-icon>
                  <q-tooltip
                    transition-show="scale"
                    transition-hide="scale"
                    class="bg-dark bXYtooltip bXYtooltip--b"
                    content-style="font-size: 12px"
                  >
                    Historique
                  </q-tooltip>
                </q-item>
              </div>
            </q-toolbar-title>

            <div class="flex flex-center">
              <q-item clickable class="flex flex-center bXYcolor--g bXYitem">
                <q-btn-dropdown label="Decouvrir" class="bXYdropdown--simple">
                  <q-list class="bXYlist">
                    <q-item clickable v-close-popup @click="onItemClick">
                      <q-item-section>
                        <q-item-label>A propos</q-item-label>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-close-popup @click="onItemClick">
                      <q-item-section>
                        <q-item-label>Blog</q-item-label>
                      </q-item-section>
                    </q-item>

                    <q-item clickable v-close-popup @click="onItemClick">
                      <q-item-section>
                        <q-item-label>Articles</q-item-label>
                      </q-item-section>
                    </q-item>
                  </q-list>
                </q-btn-dropdown> </q-item
              ><q-item
                clickable
                class="flex flex-center bXYcolor--g bXYitem q-mr-lg"
                to="#"
              >
              </q-item>

              <div class="heade__button">
                <q-item
                  clickable
                  class="q-gutter-sm q-pa-none bg-none flex flex-center"
                  tag="a"
                  to="#"
                  v-if="sessionExists()"
                >
                  <q-chip to="/merde" tag="a">
                    <q-avatar
                      color="primary"
                      text-color="white"
                      class="bXYfont--bold bXYfs--28"
                    >
                      {{ sessionInfos[0].v3[0] }}
                    </q-avatar>
                    <span v-if="sessionExists()">Bonjour, </span>
                    <span v-if="sessionExists()" class="bXYfont--bold q-ml-xs">{{
                      sessionInfos[0].v3
                    }}</span>
                  </q-chip>
                </q-item>
                <q-item
                  color="primary"
                  icon="eva-funnel-outline"
                  text-color="white"
                  class="bXYcolor--white q-mr-lg bXYbtn flex flex-center"
                  tag="a"
                  to="/auth"
                  v-else
                >
                  Ouvrir Session
                </q-item>
              </div>
            </div>
          </div>
        </q-toolbar>
      </q-header>
      <div class="bXYbg--p-w bXYmain__container">
        <router-view />
      </div>
    </q-page-container>
  </q-layout>
</template>

<script>
import { useQuasar } from "quasar";
import { defineComponent, ref, reactive } from "vue";
import userData from "local-storage";
import EssentialLink from "components/EssentialLink.vue";
import { useRouter, useRoute } from "vue-router";
import { api } from "boot/axios";
const linksList = [
  {
    active: false,
    typeFor: 0,
    title: "Home",
    caption: "quasar.dev",
    icon: "eva-home-outline",
    link: "/",
  },
  {
    active: false,
    typeFor: 0,
    title: "Livres",
    caption: "github.com/quasarframework",
    icon: "eva-grid-outline",
    link: "/livres",
  },

  {
    active: false,
    typeFor: 0,
    title: "Vos Favoris",
    caption: "forum.quasar.dev",
    icon: "eva-heart-outline",
    link: "/favorits",
  },
  {
    active: false,
    typeFor: 11,
    title: "Home admin",
    caption: "forum.quasar.dev",
    icon: "eva-layers-outline",
    link: "/admin/home",
  },
  {
    active: false,
    typeFor: 11,
    title: "Utilisateurs",
    caption: "chat.quasar.dev",
    icon: "eva-people-outline",
    link: "/admin/users",
  },

  {
    active: false,
    typeFor: 11,
    title: "Ajouter un livre",
    caption: "forum.quasar.dev",
    icon: "eva-plus-circle-outline",
    link: "/admin/addlivre",
  },

  {
    active: false,
    typeFor: 1,
    title: "Paramettres",
    caption: "Community Quasar projects",
    icon: "eva-settings-outline",
    link: "/paramettres",
  },
];

export default defineComponent({
  name: "IndexLayout",

  components: {
    EssentialLink,
  },

  setup() {
    const router = useRouter();
    const $q = useQuasar();

    function notifErrServe() {
      $q.notify({
        message: "Erreur Fatale ! Connexion serveur échouée",
        type: "warning",
        progress: true,
        timeout: 10000,
      });
    }
    const sessionExists = () => {
      return userData.get(2000);
    };
    const initCheck = () => {
      api
        .post("initCheck.php", {
          code: 1,
        })
        .then((r) => {
          // alert(r.data)
        })
        .catch((e) => {
          notifErrServe();
        });
    };
    initCheck();
    const sessionInfos = ref(null);
    sessionInfos.value = sessionExists() ? userData.get(2000) : reactive([]);
    const leftDrawerOpen = ref(false);
    const logOut = () => {
      userData.clear(2000);
      router.push("/livres");
      window.location.reload();
    };
    // userData.clear(2000)
    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      sessionInfos,
      sessionExists,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
      logOut,
    };
  },
});
</script>
