<template>
  <div class="flex flex-center">
    <div>
      <div class="q-mb-l q-mt-lg">
        <img src="others/13.png" style="max-width: 300px" />
      </div>
      <h1 class="AFJfont--bold AFJfs--24 default-title">
        Bon retour sur
        <span class="text-primary">AfrikaJungle</span>
      </h1>
      <div>
        <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-"
          style="width: 300px"
        >
          <div class="AFJinput text-left">
            <span class="label">Indentifiant</span>
            <q-input
              filled
              v-model="title"
              placeholder="Nom ou Address mail *"
              hint="Nom d'utilisateur"
              lazy-rules
              :rules="[
                (val) => (val && val.length > 0) || 'Ooups Champs recquis, Identifiant',
              ]"
            />
          </div>

          <div class="AFJinput text-left q-mt-lg">
            <span class="label">Mot de passe</span>
            <q-input
              filled
              type="password"
              v-model="password"
              placeholder="Mot de passe *"
              hint="Mot de passe"
              lazy-rules
              :rules="[
                (val) =>
                  (val !== null && val !== '') || 'Ooups Champs recquis, Mot de passe',
                (val) => (val && val.length > 2) || 'Mot de passe court',
              ]"
            />
          </div>

          <div class="flex justify-between q-mt-lg">
            <q-checkbox
              style="margin-left: -10px"
              name="accept_agreement"
              v-model="accept"
              label="Garder ma session"
            />
          </div>
          <div>
            <q-btn
              label="Se connecter"
              type="submit"
              color="primary"
              class="full-width AFJbtn q-mt-lg"
              @click="logNow()"
            />
          </div>
        </q-form>
        <div class="q-mt-md q-mL-md tex-center flex row justify-between">
          <q-item class="caption tex-center">
            <span class="AFJcolor--g AFJfs--12">© 2022 AfrikaJungle, Inc.</span>
          </q-item>
          <q-btn
            class="AFJbtn--small"
            icon="eva-github"
            text-color="primary"
            label="Sources"
            target="_blank"
            type="a"
            href=""
          ></q-btn>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useQuasar } from "quasar";
import { defineComponent, ref, onMounted, reactive } from "vue";
import session from "vue-session";
import userData from "local-storage";
import { api } from "boot/axios";
import { useRouter, useRoute } from "vue-router";
export default defineComponent({
  name: "Register",
  component: {},
  setup: () => {
    const router = useRouter();
    const $q = useQuasar();

    let title = ref("");
    let password = ref("");
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (sessionExists()) {
      router.push("/");
    }
    function notifErrLog() {
      $q.notify({
        message: "Mot de passe ou Identifiant innexistant",
        type: "negative",
        progress: true,
        timeout: 5000,
      });
    }

    function notifErrServe() {
      $q.notify({
        message: "Erreur Fatale ! Connexion serveur échouée",
        type: "warning",
        progress: true,
        timeout: 10000,
      });
    }
    const logNow = function () {
      api
        .post("logIn.php", {
          u_name: title.value,
          u_pass: password.value,
        })
        .then((r) => {
          // alert(r.data[0].code)
          if (r.data[0].code === 1) {
            let userSessionData = [
              {
                v1: r.data[0].id,
                v2: r.data[0].type,
                v3: r.data[0].name,
                v4: r.data[0].email,
                v5: r.data[0].password,
                v6: r.data[0].state,
                v7: r.data[0].phone,
              },
            ];
            userData.set(2000, userSessionData);
            // router.push("/");
            window.location.reload();
          } else {
            notifErrLog();
          }
        })
        .catch((e) => {
          notifErrServe();
        });
    };

    onMounted(() => {
      function onReset() {
        console.log("========== br ========");
      }
      onReset();
    });

    return {
      // Méthodes
      logNow,
      // Objets
      title,
      password,
      accept: ref(true),
      session,
    };
  },
});
</script>
