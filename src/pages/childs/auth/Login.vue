<template>
  <div class="flex flex-center">
    <div>
      <h1 class="bXYfont--bold bXYfs--24 default-title">Hey ! Bon retour</h1>
      <div>
        <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-md"
          style="width: 300px"
        >
          <div class="bXYinput text-left">
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

          <div class="bXYinput text-left">
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

          <div class="flex justify-between">
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
              class="full-width bXYbtn"
              @click="logNow()"
            />
          </div>
        </q-form>
        <div class="q-mt-md q-mL-md tex-center flex row justify-between">
          <q-item class="caption tex-center">
            <span class="bXYcolor--g bXYfs--12">© 2021 Bexpress Books, Inc.</span>
          </q-item>
          <q-btn
            class="bXYbtn--small"
            icon="eva-github"
            text-color="primary"
            label="Sources"
            target="_blank"
            type="a"
            href="https://github.com/vincejs77/bexpress.books"
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
        console.log("merde de tout");
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
