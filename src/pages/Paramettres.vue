<template>
  <q-page class="AFJpage">
    <div class="AFJpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="AFJfont--bold AFJfs--28">Paramètres</h1>
        <div class="q-mb-lg q-pt-xs">
          <p class="AFJcolor--g">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus at sint
            reiciendis magni, pariatur a ullam unde odio assumenda sit tempore voluptatum
          </p>
        </div>
        <div class="row justify-center">
          <q-tabs v-model="tab" dense class="AFJtab--simple AFJtab--simple q-gutter-lg">
            <q-tab name="infos" label="Informations" />
            <q-tab name="notifs" label="Notifications" />
            <q-tab name="cat" label="Autres" />
          </q-tabs>
        </div>
      </div>

      <div class="AFJpage__header__img">
        <div class="l">
          <img src="banners/png/pablita-530.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-914.png" alt="" />
        </div>
      </div>
    </div>

    <div class="AFJcontainer AFJcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="AFJfont--bold AFJfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-person-done-outline"
                class="AFJcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Informations personnelles
              <span class="AFJfont--medium AFJfs--14 AFJcolor--g q-ml-md">
                <span> (votre compte </span>
                <span> ) </span>
              </span>
            </div>
            <div style="margin-right: 1.5rem !important">
              <q-btn
                @click="parseInt(accountType) > 2 ? upMyInfo(univ) : upAdminInfo()"
                color="white"
                icon="eva-done-all-outline"
                text-color="primary"
                class="AFJcolor--white AFJbtn full-width"
                label="Enregistrer"
              />
            </div>
          </h2>

          <div class="AFJbox q-mr-lg">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
              <div class="row justify-between AFJfield--container-half">
                <div class="AFJinput">
                  <div>
                    <span class="label">Nom d'utilisateur</span>
                  </div>

                  <q-input
                    filled
                    v-model="userName"
                    placeholder="Nom d'utilisateur *"
                    hint="Nom d'utilisateur"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Ooups Champs recqui, Nom utilisateur',
                    ]"
                  />
                </div>
                <div class="AFJinput">
                  <span class="label">Mot de passe</span>
                  <q-input
                    filled
                    type="password"
                    v-model="password"
                    placeholder="Mot de passe *"
                    hint="Mot de passe"
                    lazy-rules
                    :rules="[
                      (val) => (val !== null && val !== '') || 'Ooups Champs recqui, ',
                      (val) => (val && val.length > 2) || 'Mot de passe court',
                    ]"
                  />
                </div>
              </div>
              <div class="row justify-between AFJfield--container-half">
                <div class="AFJinput">
                  <div>
                    <span class="label">Adresse mail</span>
                  </div>

                  <q-input
                    filled
                    v-model="userMail"
                    placeholder="Adresse mail *"
                    hint="Adresse mail"
                    lazy-rules
                    :rules="[
                      (val) =>
                        (val && val.length > 0) || 'Ooups Champs recqui, Adresse mail',
                    ]"
                  />
                </div>
                <div class="AFJinput">
                  <span class="label">Numéro de téléphone</span>
                  <q-input
                    filled
                    type="text"
                    v-model="userTel"
                    placeholder="Téléphone *"
                    hint="Téléphone"
                    lazy-rules
                    :rules="[
                      (val) => (val !== null && val !== '') || 'Ooups Champs recqui, ',
                      (val) => (val && val.length > 2) || 'Numéro court',
                    ]"
                  />
                </div>
              </div>
            </q-form>
          </div>
        </div>
        <div class="AFJbox--container--size-1--custom q-mt-lg relative-position">
          <div class="AFJbox AFJbox--container--size-1--custom">
            <div
              class="AFJfont--bold text-center AFJfs--20 no-wrap row justify-between flex-center padding--none"
            >
              <div class="text-center">Invitez vos amis à utiliser AfrikaJungle</div>
            </div>
            <p class="text-center AFJcolor--g q-mt-md">
              Lorem ipsum dolor sit amet consectetur
            </p>

            <div
              class="row justify-between flex flex-center AFJfield--container-full q-pb-md"
            >
              <div class="AFJinput">
                <q-input
                  filled
                  v-model="appLink"
                  placeholder="Adresse mail *"
                  hint="Adresse mail"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Ooups Champs recqui']"
                />
              </div>
              <div class="AFJinput">
                <q-btn
                  color="primary"
                  icon="eva-done-all-outline"
                  text-color="white"
                  label="Copier le lien"
                  class="AFJcolor--white AFJbtn full-width q-mt-md"
                />
              </div>
            </div>
          </div>
          <div class="flex flex-center"></div>
        </div>
      </div>
    </div>

    <div class="AFJcontainer AFJcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="AFJfont--bold AFJfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-person-done-outline"
                class="AFJcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Vos Catécories Favorites
              <span class="AFJfont--medium AFJfs--14 AFJcolor--g q-ml-md">
                <span> (votre compte </span>
                <span> ) </span>
              </span>
            </div>
            <div style="margin-right: 1.5rem !important">
              <q-btn
                @click="parseInt(accountType) > 2 ? setMyCat(favCatsFromServer) : null"
                color="white"
                icon="eva-done-all-outline"
                text-color="primary"
                class="AFJcolor--white AFJbtn--simple AFJbtn full-width"
                label="Enregistrer"
              />
            </div>
          </h2>

          <div class="AFJbox q-mr-lg">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
              <div class="AFJfield--container-full">
                <div class="AFJinput">
                  <span class="label">Mes catégories</span>
                  <q-select
                    filled
                    v-model="favCatsFromServer"
                    use-input
                    use-chips
                    multiple
                    input-debounce="0"
                    @new-value="createValuefavCats"
                    :options="favCatsOptions"
                    style="width: 100%"
                    hint="Catégories favorites (une ou plusieurs)"
                    placeholder="Catégories favorites"
                    class="AFJcustom--select"
                  />
                </div>
              </div>
            </q-form>
          </div>
        </div>
        <div class="AFJbox--container--size-1--custom q-mt-lg">
          <div class="AFJbox--container--size-1--custom"></div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, ref, reactive } from "vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
import { api } from "boot/axios";

const univOptionsString = reactive([
  "UCB - Université Catholique de Bukavu",
  "UEA - Université Evangelique en Afrique",
  "UOB - Université Officiel de Bukavu",
]);

export default defineComponent({
  name: "Paramettres",
  setup: () => {
    const router = useRouter();
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (!sessionExists()) {
      router.push("/auth");
    }
    //Variables
    var userName = "";

    return {
      tab: ref("infos"),
      appLink: "https://afrikajungle.vercel.app",
      userName,

      //Select functions

      createVakueUniv(val, done) {
        if (val.length > 0) {
          if (!univOptionsString.includes(val)) {
            univOptionsString.push(val);
          }
          done(val, "toggle");
        }
      },
      filterUniv(val, update) {
        setTimeout(() => {
          update(() => {
            if (val === "") {
              univOptions.value = univOptionsString;
            } else {
              const needle = val.toLowerCase();
              univOptions.value = univOptionsString.filter(
                (v) => v.toLowerCase().indexOf(needle) > -1
              );
            }
          });
        }, 500);
      },
      createValuefavCats(val, done) {
        if (val.length > 0) {
          if (!favCatsOptionsString.includes(val)) {
            favCatsOptionsString.push(val);
          }
          done(val, "toggle");
        }
      },

      filterfavCats(val, update) {
        setTimeout(() => {
          update(() => {
            if (val === "") {
              favCatsOptions.value = favCatsOptionsString;
            } else {
              const needle = val.toLowerCase();
              favCatsOptions.value = favCatsOptionsString.filter(
                (v) => v.toLowerCase().indexOf(needle) > -1
              );
            }
          });
        }, 500);
      },
    };
  },
});
</script>
