<template>
  <q-page class="bXYpage">
    <div class="bXYpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="bXYfont--bold bXYfs--28">
          Gestion des <span class="bXYline">Utilisateurs <span></span></span>
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
          <img src="banners/png/2.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-success.png" alt="" />
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
                <q-tab name="users" label="Utilisateurs" />
                <q-tab name="univ" label="Universités" />
                <q-tab name="admin" label="Administrateurs" />
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
              :rows="userList"
              :columns="columns"
              row-key="id"
              v-model:selected="selected"
              virtual-scroll
            >
              <template v-slot:body="props">
                <q-tr :props="props" @click="props.selected = true">
                  <q-td auto-width>
                    <q-checkbox v-model="props.selected"></q-checkbox>
                  </q-td>

                  <q-td key="name" :props="props">
                    {{ props.row.name }}
                  </q-td>
                  <q-td key="email" :props="props">
                    {{ props.row.email }}
                  </q-td>
                  <q-td key="phone" :props="props">
                    {{ props.row.phone }}
                  </q-td>
                  <q-td key="univ" :props="props">
                    {{ props.row.univ }}
                  </q-td>
                  <q-td key="state" :props="props">
                    <q-chip size="md" class="true" v-if="props.row.state">
                      Activated
                    </q-chip>
                    <q-chip size="md" class="false" v-else>Disabled</q-chip>
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
    name: "name",
    required: true,
    label: "Nom Utilisateurs",
    align: "left",
    field: (row) => row.name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "email",
    align: "left",
    label: "Adresse Mail",
    field: "email",
    sortable: true,
  },
  {
    name: "phone",
    label: "Numéro de Téléphone (+243)",
    align: "left",
    field: "phone",
  },
  {
    name: "univ",
    label: "Université",
    align: "left",
    field: "univ",
  },
  {
    name: "state",
    label: "Statut",
    align: "left",
    field: "state",
  },
];
export default defineComponent({
  name: "users",

  setup() {
    const router = useRouter();
    let accountType =ref(null)
    const selected = ref([]);
    var userList = ref(reactive([]))
       const sessionExists = () => {
    return userData.get(2000);
    };
    if (!sessionExists()) {
      router.push("/auth");
    }
    if (sessionExists()) {
      accountType.value = userData.get(2000)[0].v2
      if (parseInt(accountType.value) > 2) {
        router.push("/");
      }
    }
    const setUser = () => {
      api.post('adminUser.php', {
          code: 1
        }).then((r) => {
         userList.value = r.data
        }).catch((e) => {
          alert(e)
        })
    };
    setUser()
    return {
      tab: ref("users"),
      selected,
      columns,
      userList,

      getSelectedString() {
        return selected.value.length === 0
          ? ""
          : `${selected.value.length} record${
              selected.value.length > 1 ? "s" : ""
            } selected of ${rows.length}`;
      },
    };
  },
});
</script>
