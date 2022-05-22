<template>
  <q-item
    :style="
      parseInt(typeFor) == 0 ||
      (sessionExists() && parseInt(accountType) < 3) ||
      (sessionExists() && parseInt(typeFor) === 1)
        ? ''
        : 'display:none'
    "
    clickable
    tag="a"
    :to="link"
    :href="link"
    class="flex flex-center"
  >
    <q-item-section v-if="icon" avatar class="flex flex-center">
      <q-icon :name="icon" size="24px" content-style="font-size: 12px" />
      <q-tooltip
        anchor="center right"
        transition-show="scale"
        transition-hide="scale"
        self="center left"
        class="bg-dark AFJtooltip AFJtooltip--r"
        content-style="font-size: 12px"
      >
        {{ title }}
      </q-tooltip>
      <div class="q-mt-xs">
        <span>
          {{ title }}
        </span>
      </div>
    </q-item-section>

    <!-- <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>
        {{ caption }}
      </q-item-label> 
    </q-item-section> -->
  </q-item>
</template>

<script>
import { defineComponent } from "vue";
import userData from "local-storage";
import { useRouter, useRoute } from "vue-router";
export default defineComponent({
  name: "EssentialLink",
  setup: () => {
    const router = useRouter();
    var accountType = null;
    const sessionExists = () => {
      return userData.get(2000);
    };
    if (sessionExists()) {
      accountType = userData.get(2000)[0].v2;
    }
    return {
      accountType,
      sessionExists,
    };
  },
  props: {
    active: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      required: true,
    },

    caption: {
      type: String,
      default: "",
    },

    link: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
      default: "",
    },
    typeFor: {
      type: String,
      default: "",
    },
  },
});
</script>
