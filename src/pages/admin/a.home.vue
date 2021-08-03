<template>
  <q-page class="bXYpage">
    <div class="bXYpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="bXYfont--bold bXYfs--28">
          Gestion des <span class="bXYline">livres<span></span></span>
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
              placeholder="Rechercher un utilisateur"
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
          <img src="banners/png/pablita-rating.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-689.png" alt="" />
        </div>
      </div>
    </div>

    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-people-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Liste des Utilisateurs
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (Au total </span>
                <span class="bXYfont--bold bXYcolor--p"> 259 </span>
                <span> ) </span>
              </span>
            </div>
            <div class="flex row justify-end">
              <q-tabs
                v-model="tab"
                dense
                class="bXYtab--simple bXYtab--simple-r q-gutter-lg"
              >
                <q-tab name="livres" label="Livres" />
                <q-tab name="cats" label="Catégories et sous-catégories" />
              </q-tabs>

              <q-btn-dropdown
                text-color="primary"
                class="bXYbtn q-ml-lg"
                color="white"
                label="Actions"
                icon="eva-more-vertical-outline"
              >
                <div class="bXYdropdown--filter">
                  <div class="flex flex-center">
                    <q-btn
                      color="negative"
                      @click="delLivres(selected)"
                      icon="eva-trash-outline"
                      text-color="white"
                      class="bXYcolor--white q-mr-lg bXYbtn full-width"
                      label="Supprimer"
                    />
                    <q-btn
                      color="white"
                      icon="eva-edit-outline"
                      text-color="primary"
                      class="bXYcolor--white q-mr-lg q-mt-md bXYbtn full-width"
                      label="Modifier"
                    />
                  </div>
                </div>
              </q-btn-dropdown>
            </div>
          </h2>

          <div class="">
            <q-table
              ref="tableRef"
              :selected-rows-label="getSelectedString"
              selection="multiple"
              :rows="livres"
              :columns="columns"
              row-key="id"
              v-model:selected="selected"
              virtual-scroll
              class="bXYtable--livres"
            >
              <template v-slot:body="props">
                <q-tr :props="props" @click="props.selected = true">
                  <q-td auto-width>
                    <q-checkbox v-model="props.selected"></q-checkbox>
                  </q-td>

                  <q-td key="img" :props="props" auto-width>
                    <div class="flex justify-start">
                      <img :src="props.row.img" alt="" />
                    </div>
                  </q-td>
                  <q-td class="w1">
                    <div class="full-heigh">
                      <div class="title" key="title" :props="props">
                        {{ props.row.title }}
                      </div>
                      <p class="subtitle" key="cat" :props="props">
                        {{ props.row.cat }}
                      </p>
                    </div>
                  </q-td>
                  <q-td class="w1">
                    <div class="full-heigh">
                      <div class="title" key="author" :props="props">
                        {{ props.row.cat }}
                      </div>
                      <p class="subtitle" key="edit" :props="props">
                        {{ props.row.cat }}
                      </p>
                    </div>
                  </q-td>
                  <q-td key="stars" :props="props">
                    <q-rating
                      size="16px"
                      v-model="props.row.cat"
                      :max="5"
                      color="warning"
                    />
                    <p class="subtitle caption">4.2 (551)</p>
                  </q-td>

                  <q-td class="w1" key="vues" :props="props" auto-width>
                    <q-chip size="sm"> {{ props.row.vues }} </q-chip>
                  </q-td>
                </q-tr>
              </template>
            </q-table>
            <div class="q-mt-md">Selectionnés: {{ JSON.stringify(selected) }}</div>
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
import { defineComponent, ref, reactive } from "vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
import { api } from 'boot/axios'

const columns = [
  {
    name: "img",
    required: true,
    label: "#",
    align: "left",
    field: (row) => row.name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "title",
    align: "left",
    label: "Titre & Catégorie",
    field: "title",
    sortable: true,
  },
  {
    name: "file",
    align: "left",
    label: "Auteur & Editeur",
    field: "title",
    sortable: true,
  },
  {
    name: "stars",
    label: "Notations",
    align: "left",
    field: "stars",
  },
  {
    name: "vues",
    label: "Nombre de vues",
    align: "left",
    field: "vues",
  },
];

export default defineComponent({
  name: "users",

  setup() {
    const router = useRouter();
    const selected = ref([]);
    var livres = ref(reactive([]))
    let accountType =ref(null)
    const addBookFav = (index, livre, favs) => {
      api
        .post("/livres.php", {
          code: 1
        })
        .then((r) => {
          livres.value = r.data
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    };
    const delLivres = (dellivres) =>{
        api
        .post("/livres.php", {
          code: 9,
          livres: dellivres
        })
        .then((r) => {
          alert(r.data)
        })
        .catch((e) => {
          console.log("serveur non dis");
        });
    }
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (sessionExists()) {
      accountType.value = userData.get(2000)[0].v2
      if (parseInt(accountType.value) > 2) {
        router.push("/");
      }
    }
    addBookFav()
    return {
      tab: ref("livres"),
      selected,
      columns,
      livres,
      delLivres,
      getSelectedString() {
        return selected.value.length === 0
          ? ""
          : `${selected.value.length} record${
              selected.value.length > 1 ? "s" : ""
            } selected of ${livres.length}`;
      },
    };
  },
});
</script>
