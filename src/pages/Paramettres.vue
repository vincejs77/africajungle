<template>
  <q-page class="bXYpage">
    <div class="bXYpage__header row justify-center flex flex-center relative-position">
      <div class="text-center">
        <h1 class="bXYfont--bold bXYfs--28">Paramettres</h1>
        <div class="q-mb-lg q-pt-xs">
          <p class="bXYcolor--g">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus at sint
            reiciendis magni, pariatur a ullam unde odio assumenda sit tempore voluptatum
          </p>
        </div>
        <div class="row justify-center">
          <q-tabs v-model="tab" dense class="bXYtab--simple bXYtab--simple q-gutter-lg">
            <q-tab name="infos" label="Informations" />
            <q-tab name="notifs" label="Notifications" />
            <q-tab name="cat" label="Autres" />
          </q-tabs>
        </div>
      </div>

      <div class="bXYpage__header__img">
        <div class="l">
          <img src="banners/png/pablita-530.png" alt="" />
        </div>
        <div class="r">
          <img src="banners/png/pablita-914.png" alt="" />
        </div>
      </div>
    </div>

    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between">
            <div>
              <q-icon
                name="eva-person-done-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Informations personnelles
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (votre compte </span>
                <span> ) </span>
              </span>
            </div>
            <div style="margin-right: 1.5rem !important">
              <q-btn
              @click="parseInt(accountType) > 2 ? upMyInfo(univ):upAdminInfo()"
                color="white"
                icon="eva-done-all-outline"
                text-color="primary"
                class="bXYcolor--white bXYbtn full-width"
                label="Enregistrer"
              />
            </div>
          </h2>

          <div class="bXYbox q-mr-lg">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
              <div class="row justify-between bXYfield--container-half">
                <div class="bXYinput">
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
                <div class="bXYinput">
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
              <div class="row justify-between bXYfield--container-half">
                <div class="bXYinput">
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
                <div class="bXYinput">
                  <span class="label">Numeron de téléphone</span>
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
              <div class="bXYfield--container-full">
                <div class="bXYinput">
                  <span class="label">Univertisé</span>
                  <q-select
                    filled
                    v-model="univ"
                    use-input
                    use-chips
                    input-debounce="0"
                    @new-value="createVakueUniv"
                    :options="univOptions"
                    style="width: 100%"
                    hint="Votre Université (une seule)"
                    placeholder="Univertisté"
                    class="bXYcustom--select full-width"
                  />
                </div>
              </div>
            </q-form>
          </div>
        </div>
        <div class="bXYbox--container--size-1--custom q-mt-lg relative-position">
          <div class="bXYbox bXYbox--container--size-1--custom">
            <div
              class="bXYfont--bold text-center bXYfs--20 no-wrap row justify-between flex-center padding--none"
            >
              <div class="text-center">Invitez vos amis à utiliser bookExpress</div>
            </div>
            <p class="text-center bXYcolor--g q-mt-md">
              Lorem ipsum dolor sit amet consectetur
            </p>

            <div
              class="row justify-between flex flex-center bXYfield--container-full q-pb-md"
            >
              <div class="bXYinput">
                <q-input
                  filled
                  v-model="appLink"
                  placeholder="Adresse mail *"
                  hint="Adresse mail"
                  lazy-rules
                  :rules="[
                    (val) =>
                      (val && val.length > 0) || 'Ooups Champs recqui, Adresse mail',
                  ]"
                />
              </div>
              <div class="bXYinput">
                <q-btn
                  color="primary"
                  icon="eva-done-all-outline"
                  text-color="white"
                  label="Copier le lien"
                  class="bXYcolor--white bXYbtn full-width q-mt-md"
                />
              </div>
            </div>
            <div style="height: 120px"></div>

            <div class="absolute" style="bottom: -0.7rem">
              <img
                src="banners/png/pablita-coming-soon-1.png"
                alt=""
                style="width: 250px"
              />
            </div>
          </div>
          <div class="flex flex-center"></div>
        </div>
      </div>
    </div>

    <div class="bXYcontainer bXYcontainer__fxs overflow-hidden">
      <div class="row justify-lg-start no-wrap">
        <div class="full-width">
          <h2 class="bXYfont--bold bXYfs--20 no-wrap row justify-between flex-center">
            <div>
              <q-icon
                name="eva-person-done-outline"
                class="bXYcolor--g q-mr-md"
                style="margin-top: -3px"
              />
              Vos Catécories Favorites
              <span class="bXYfont--medium bXYfs--14 bXYcolor--g q-ml-md">
                <span> (votre compte </span>
                <span> ) </span>
              </span>
            </div>
            <div style="margin-right: 1.5rem !important">
              <q-btn
              @click="parseInt(accountType) > 2 ? setMyCat(favCatsFromServer):null"
                color="white"
                icon="eva-done-all-outline"
                text-color="primary"
                class="bXYcolor--white bXYbtn--simple bXYbtn full-width"
                label="Enregistrer"
              />
            </div>
          </h2>

          <div class="bXYbox q-mr-lg">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
              <div class="bXYfield--container-full">
                <div class="bXYinput">
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
                    class="bXYcustom--select"
                  />
                </div>
              </div>
            </q-form>
          </div>
        </div>
        <div class="bXYbox--container--size-1--custom q-mt-lg">
          <div class="bXYbox--container--size-1--custom"></div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, ref, reactive } from "vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
import{ api } from 'boot/axios'

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
    const univOptions = ref(reactive([]));
    const favCatsOptions = ref(reactive([]));
    let univ = ref(univOptionsString[0]);
    var favCats = reactive([]);
    var favCatsFromServer = ref(reactive([]));
    var userName = ref(null)
    var password = ref(null)
    var userMail = ref(null)
    var userTel = ref(null)
    var userID = ref(null)
    var userType = ref(null)
    var userState = ref(null)
    var accountType = ref(null)
    if (sessionExists()) {
      accountType.value = userData.get(2000)[0].v2
      userName.value = userData.get(2000)[0].v3
      password.value = userData.get(2000)[0].v5
      userMail.value = userData.get(2000)[0].v4
      userTel.value = userData.get(2000)[0].v7
      userID.value = userData.get(2000)[0].v1
      userType.value = userData.get(2000)[0].v2
      userState.value = userData.get(2000)[0].v6
    }
      const getAllCats = () => {
        api.post('settings.php', {
          code: 1,
        }).then((r) => {
          favCatsOptions.value = r.data
        }).catch((e) => {
          alert(e)
        })
      }
      getAllCats()
      const upMyInfo = (univ) => {
        // alert(univ)
        api.post('userFile.php', {
          code: 1,
          myid: userID.value,
          userName: userName.value,
          password: userData.get(2000)[0].v5,
          userMail: userData.get(2000)[0].v4,
          userTel: userTel.value,
          univ: univ
        }).then((r) => {
          // alert(r.data)
          if (r.data[0].code === 1) {
            let userSessionData = [{
            v1: userID.value,
            v2: userType.value,
            v3: userName.value,
            v4: userMail.value,
            v5: password.value,
            v6: userState.value,
            v7: userTel.value
          }]
          userData.set(2000, userSessionData)
          userName.value = userData.get(2000)[0].v3
          password.value = userData.get(2000)[0].v5
          userMail.value = userData.get(2000)[0].v4
          userTel.value = userData.get(2000)[0].v7
          userID.value = userData.get(2000)[0].v1
          userType.value = userData.get(2000)[0].v2
          userState.value = userData.get(2000)[0].v6
        }
        }).catch((e) => {
          alert(e)
        })
      }
      const upAdminInfo = () => {
        // alert('vous etes admin attendez')
        api.post('userFile.php', {
          code: 5,
          userName: userName.value,
          password: userData.get(2000)[0].v5,
          userMail: userData.get(2000)[0].v4,
          new_password: password.value,
          new_userMail: userMail.value,
          userTel: userTel.value
        }).then((r) => {
          // alert(r.data)
          if (r.data[0].code === 1) {
            let userSessionData = [{
            v1: userID.value,
            v2: userType.value,
            v3: userName.value,
            v4: userMail.value,
            v5: password.value,
            v6: userState.value,
            v7: userTel.value
          }]
          userData.set(2000, userSessionData)
          userName.value = userData.get(2000)[0].v3
          password.value = userData.get(2000)[0].v5
          userMail.value = userData.get(2000)[0].v4
          userTel.value = userData.get(2000)[0].v7
          userID.value = userData.get(2000)[0].v1
          userType.value = userData.get(2000)[0].v2
          userState.value = userData.get(2000)[0].v6
        }
        }).catch((e) => {
          alert(e)
        })
      }
      const getMyCat = () => {
        api.post('userFile.php', {
          code: 2,
          myid: userID.value
        }).then((r) => {
          favCatsFromServer.value = r.data
        }).catch((e) => {
          alert(e)
        })
      }
      getMyCat()
      const getUniv = () => {
        api.post('settings.php', {
          code: 3,
          myid: userID.value
        }).then((r) => {
          univOptions.value = r.data
        }).catch((e) => {
          alert(e)
        })
      }
      getUniv()
      const getMyUniv = () => {
        api.post('userFile.php', {
          code: 4,
          myid: userID.value
        }).then((r) => {
          // alert(r.data[0])
          univ.value = r.data[0]
        }).catch((e) => {
          alert(e)
        })
      }
      getMyUniv()
      const setMyCat = (fCat) => {
        api.post('userFile.php', {
          code: 3,
          myid: userID.value,
          mycat: fCat
        }).then((r) => {
          // alert(r.data)
        }).catch((e) => {
          alert(e)
        })
      }
    return {
      tab: ref("infos"),
      appLink: "http://localhost:8080/#/paramettres",
      userName,
      password,
      userMail,
      userTel,
      userID,
      userType,
      userState,
      userData,
      univ,
      univOptions,
      accountType,
      favCats,
      favCatsFromServer,
      favCatsOptions,
      upMyInfo,
      upAdminInfo,
      setMyCat,

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
