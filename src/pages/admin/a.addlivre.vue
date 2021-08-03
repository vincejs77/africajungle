<template>
  <q-page class="flex flex-center">
    <div>
      <div class="bXYcontainer flex flex-center justify-center">
        <div>
          <img src="others/5.png" width="300px" />
        </div>
        <div class="bXYbg--w bXYbox bXYform bXYform--addlivre">
          <h1 class="bXYfont--bold bXYfs--24 default-title">
            {{ img }}Ajouter un livre !
          </h1>
          <div>
            <q-form @submit="onSubmit" @reset="onReset" class="">
              <q-uploader
                url="http://localhost:4444/upload"
                label="Custom header"
                accept=".jpg, image/*"
                max-files="1"
                class="fille-header--none"
              >
                <template v-slot:header="scope">
                  <div class="row no-wrap items-center q-pa-sm q-gutter-xs">
                    <q-spinner v-if="scope.isUploading" class="q-uploader__spinner" />
                    <div class="col">
                      <div class="q-uploader__title">Image (Couverture) du livre</div>
                      <div class="q-uploader__subtitle">
                        Taille: {{ scope.uploadSizeLabel }} /
                        {{ scope.uploadProgressLabel }}
                      </div>
                    </div>
                    <q-btn
                      v-if="scope.canAddFiles"
                      type="a"
                      icon="eva-image-outline"
                      round
                      dense
                      flat
                    >
                      <q-uploader-add-trigger />
                      <q-tooltip>Parcourir</q-tooltip>
                    </q-btn>

                    <q-btn
                      v-if="scope.queuedFiles.length > 0"
                      icon="eva-trash-outline"
                      @click="scope.removeQueuedFiles"
                      round
                      dense
                      flat
                    >
                      <q-tooltip>Annuler</q-tooltip>
                    </q-btn>

                    <q-btn
                      v-if="scope.isUploading"
                      icon="eva-trash-outline"
                      @click="scope.abort"
                      round
                      dense
                      flat
                    >
                      <q-tooltip>Annuler Upload</q-tooltip>
                    </q-btn>
                  </div>
                </template>
              </q-uploader>
              <p class="bXYfield">
                <input
                  @change="changeCover()"
                  name="coverP"
                  id="coverP"
                  class="coverP dis-none"
                  type="file"
                />
                <label for="coverP">Couverture</label>
              </p>

              <p class="bXYfield">
                <q-uploader
                  :url="img"
                  label="Custom header"
                  accept=".pdf, docs/*"
                  max-files="1"
                >
                  <template v-slot:header="scope">
                    <div class="row no-wrap items-center q-pa-sm q-gutter-xs">
                      <q-spinner v-if="scope.isUploading" class="q-uploader__spinner" />
                      <div class="col">
                        <div class="q-uploader__title">Fichier (.PDF)</div>
                        <div class="q-uploader__subtitle">
                          Taille: {{ scope.uploadSizeLabel }} /
                          {{ scope.uploadProgressLabel }}
                        </div>
                      </div>
                      <q-btn
                        v-if="scope.canAddFiles"
                        type="a"
                        icon="eva-file-outline"
                        round
                        dense
                        flat
                      >
                        <q-uploader-add-trigger />
                        <q-tooltip>Parcourir</q-tooltip>
                      </q-btn>

                      <q-btn
                        v-if="scope.queuedFiles.length > 0"
                        icon="eva-trash-outline"
                        @click="scope.removeQueuedFiles"
                        round
                        dense
                        flat
                      >
                        <q-tooltip>Annuler</q-tooltip>
                      </q-btn>

                      <q-btn
                        v-if="scope.isUploading"
                        icon="eva-trash-outline"
                        @click="scope.abort"
                        round
                        dense
                        flat
                      >
                        <q-tooltip>Abort Upload</q-tooltip>
                      </q-btn>
                    </div>
                  </template>
                </q-uploader>
              </p>
              <p class="bXYfield">
                <input
                  @change="changePdf()"
                  name="PDF"
                  id="PDF"
                  class="PDF dis-none"
                  type="file"
                />
                <label for="PDF">PDF</label>
              </p>
              <div class="bXYinput">
                <span class="label">Titre</span>
                <q-input
                  filled
                  v-model="title"
                  placeholder="Titre *"
                  hint="Titre du livre"
                  lazy-rules
                  :rules="[
                    (val) => (val && val.length > 0) || 'Ooups Champs recqui, Titre',
                  ]"
                />
              </div>

              <div class="bXYfield">
                <q-input
                  filled
                  type="text"
                  v-model="desc"
                  placeholder="Description *"
                  hint="Description du livre"
                  lazy-rules
                  :rules="[
                    (val) =>
                      (val !== null && val !== '') || 'Ooups Champs recqui, Description',
                    (val) => (val && val.length > 2) || 'Trop court court',
                  ]"
                />
              </div>

              <div class="bXYfield">
                <q-input
                  filled
                  type="text"
                  v-model="edit"
                  placeholder="Editeur *"
                  hint="Editeur du livre"
                  lazy-rules
                  :rules="[
                    (val) =>
                      (val !== null && val !== '') || 'Ooups Champs recqui, Editeur',
                    (val) => (val && val.length > 2) || 'Trop court court',
                  ]"
                />
              </div>

              <div class="bXYfield">
                <q-input
                  filled
                  type="text"
                  v-model="isbn"
                  placeholder="ISBN *"
                  hint="ISBN du livre"
                  lazy-rules
                  :rules="[
                    (val) => (val !== null && val !== '') || 'Ooups Champs recqui, ISBN',
                    (val) => (val && val.length > 2) || 'Mot de passe court',
                  ]"
                />
              </div>

              <div class="flex justify-between bXYfield">
                <q-select
                  filled
                  v-model="cat"
                  use-input
                  use-chips
                  input-debounce="0"
                  @new-value="createValueCat"
                  :options="catOptions"
                  style="width: 100%"
                  hint="Catégorie du livre (une seule)"
                  placeholder="Catégorie"
                  class="bXYcustom--select"
                />
              </div>

              <div class="flex justify-between bXYfield--custom">
                <q-select
                  filled
                  v-model="sousCats"
                  use-input
                  use-chips
                  multiple
                  input-debounce="0"
                  @new-value="createValueSousCats"
                  :options="sousCatsOptions"
                  style="width: 100%"
                  hint="Sous-catégories du livre (une ou plusieurs)"
                  placeholder="Sous-catégories"
                  class="bXYcustom--select"
                />
              </div>

              <div class="flex justify-between bXYfield--custom">
                <q-select
                  filled
                  v-model="bookYear"
                  use-input
                  use-chips
                  input-debounce="0"
                  @new-value="createValueYears"
                  :options="bookYears[0]"
                  @filter="filterYears"
                  style="width: 100%"
                  hint="Catégorie du livre (une seule)"
                  placeholder="Catégorie"
                  class="bXYcustom--select"
                />
              </div>

              <div class="flex justify-between bXYfield--custom">
                <q-toggle
                  v-model="accept"
                  label="Je valide que les informations sont vérifiées"
                />
              </div>

              <div>
                <q-btn
                  label="Valider le formulaire"
                  type="submit"
                  color="primary"
                  icon="eva-navigation-2-outline"
                  class="q-mt-sm full-width bXYbtn"
                  @click="addNow()"
                />

                <q-btn
                  label="Formater le formulaire"
                  type="reset"
                  color="white"
                  icon="eva-refresh-outline"
                  text-color="primary"
                  class="bXYcolor--white q-mt-md full-width bXYbtn"
                  @onClick="onReset()"
                />
              </div>
            </q-form>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, reactive, ref, onMounted } from "vue";
import { api } from "boot/axios";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
const catOptionsString = reactive([
  "Categorie",
  "Je suis une catégorie",
  "Histoire grec",
  "Union sovietique",
  "Rapport Mapping",
]);
const sousCatsOptionsString = reactive([
  "Sous categorie",
  "Je suis une sous cat",
  "Bangladesh",
  "Sombrero",
  "Chevre de Monsieur Segin",
]);

export default defineComponent({
  name: "adminAddLivres",
  components: {},
  setup: () => {
    let title = ref("");
    let desc = ref("");
    let file = ref("");
    let isbn = ref("");
    let cat = ref(null);
    let cover = ref(null);
    let img = ref(null);
    let edit = ref("");
    let sousCats = ref(null);
    let vues = ref(null);
    let stars = ref(null);
    let inFav = ref(false);
    let pdf = ref(null);
    let bookYear = ref(null);
    let accountType =ref(null)

    const router = useRouter();
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
    const bookYears = reactive([]);
    const catOptions = ref(reactive([]));
    const sousCatsOptions = ref(reactive([]));
    const getAllCats = () => {
        api.post('settings.php', {
          code: 1,
        }).then((r) => {
          catOptions.value = r.data
        }).catch((e) => {
          alert(e)
        })
      }
      getAllCats()
    const getAllSousCats = () => {
        api.post('settings.php', {
          code: 2,
        }).then((r) => {
          sousCatsOptions.value = r.data
        }).catch((e) => {
          alert(e)
        })
      }
      getAllSousCats()
    const changeCover = () => {
      cover = document.querySelector(".coverP").files[0];
      if (
        document.querySelector(".coverP").files &&
        document.querySelector(".coverP").files[0]
      ) {
        let usr_pic = new FileReader();
        usr_pic.onload = (e) => {
          // this.img = ('src', e.target.result)
        };
        usr_pic.readAsDataURL(document.querySelector(".coverP").files[0]);
      }
    };
    const changePdf = () => {
      pdf = document.querySelector(".PDF").files[0];
      if (
        document.querySelector(".PDF").files &&
        document.querySelector(".PDF").files[0]
      ) {
        let usr_pic = new FileReader();
        usr_pic.onload = (e) => {
          // this.img = ('src', e.target.result)
        };
        usr_pic.readAsDataURL(document.querySelector(".PDF").files[0]);
      }
    };
    const addNow = () => {
      var frm = new FormData();
      frm.append("title", title.value);
      frm.append("desc", desc.value);
      frm.append("edit", edit.value);
      frm.append("isbn", isbn.value);
      frm.append("cat", cat.value);
      frm.append("sousCats", sousCats);
      frm.append("myid", null);
      frm.append("annee", bookYear.value);
      frm.append("cover", cover);
      frm.append("pdf", pdf);
      api
        .post("addBook.php", frm, {
          header: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((r) => {
          // if(r.data[0].code == 1) {
          alert(r.data);
          // } else {
          //   alert(r.data)
          // }
        })
        .catch((res) => {
          alert("serveur non disponible");
        });
    };

    onMounted(() => {});
    function getYear() {
      api
        .post("simpleCode.php", {
          code: 1
        })
        .then((r) => {
          bookYears[0] = r.data;
          console.log(r.data);
        })
        .catch((r) => {
          alert("serveur non disponible");
        });
    }

    getYear();
    return {
      //functions

      getYear,

      //à envoiyer dans la bd par le forumlaire

      id: ref(""),
      img,
      title,
      desc,
      file,
      isbn,
      cat,
      catOptions,
      edit,
      sousCats,
      sousCatsOptions,

      //donnée non entrée mais traitées par le système
      vues: ref(null),
      stars: ref(null),
      inFav: ref(false),

      //concerne le formulaire uniquement : validation
      accept: ref(false),
      model: ref(null),
      cover,
      pdf,
      bookYear,
      bookYears,

      createValueCat(val, done) {
        if (val.length > 0) {
          if (!catOptionsString.includes(val)) {
            catOptionsString.push(val);
          }
          done(val, "toggle");
        }
      },

      filterCat(val, update) {
        setTimeout(() => {
          update(() => {
            if (val === "") {
              catOptions.value = catOptionsString;
            } else {
              const needle = val.toLowerCase();
              catOptions.value = catOptionsString.filter(
                (v) => v.toLowerCase().indexOf(needle) > -1
              );
            }
          });
        }, 500);
      },

      createValueSousCats(val, done) {
        if (val.length > 0) {
          if (!sousCatsOptionsString.includes(val)) {
            sousCatsOptionsString.push(val);
          }
          done(val, "toggle");
        }
      },

      filterSousCats(val, update) {
        setTimeout(() => {
          update(() => {
            if (val === "") {
              sousCatsOptions.value = sousCatsOptionsString;
            } else {
              const needle = val.toLowerCase();
              sousCatsOptions.value = sousCatsOptionsString.filter(
                (v) => v.toLowerCase().indexOf(needle) > -1
              );
            }
          });
        }, 500);
      },
      addNow,
      changeCover,
      changePdf,
    };
  },
});
</script>
