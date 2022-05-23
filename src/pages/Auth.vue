<template>
  <q-page class="">
    <q-dialog v-model="dialogAuth" persistent>
      <div class="logingFrame">
        <div class="AFJcontainer text-center flex flex-center justify-center">
          <div class="AFJbg--w AFJbox">
            <div class="row justify-between">
              <div class="flex flex-center">
                <q-item clickable tag="a" to="/" href="/" class="flex flex-center">
                  <img src="logo.png" style="max-width: 40px" />
                </q-item>
              </div>
              <div class="flex-center">
                <q-tabs active-color="primary">
                  <q-route-tab
                    class="AFJfont--medium"
                    name="connexion"
                    label="Connexion"
                    :to="linkLogin"
                    exact
                  />
                  <q-route-tab
                    class="AFJfont--medium q-ml-lg"
                    name="inscription"
                    label="Inscription"
                    :to="linkRegister"
                    exact
                  />
                </q-tabs>
              </div>
            </div>

            <div class="flex flex-center">
              <router-view />
            </div>
          </div>
        </div>
      </div>
    </q-dialog>
  </q-page>
</template>

<script>
import { defineComponent, ref } from "vue";
import Login from "./childs/auth/Login.vue";
import Register from "./childs/auth/Register.vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
export default defineComponent({
  name: "Auth",
  components: {
    Login,
    Register,
  },
  setup: () => {
    const router = useRouter();
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (sessionExists()) {
      router.push("/");
    }
    const dialogAuth = ref(true);
    const position = ref("");

    return {
      linkLogin: ref("/auth"),
      linkRegister: ref("/auth/register"),

      dialogAuth,
      position,
      open(pos) {
        position.value = pos;
        dialog.value = true;
      },
    };
  },
});
</script>

<style>
.q-tabs__content--align-justify .q-tab {
  flex: none !important;
}
.q-tab {
  padding: 0px;
  text-transform: none;
  min-height: 20px;
}
</style>
