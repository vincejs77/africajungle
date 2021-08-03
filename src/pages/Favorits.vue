<template>
    <q-page class="flex flex-center">
        <div>
        <div class="bXYcontainer text-center">
            <img src="logo.png">
            <h1 class="bXYfont--bold bXYfs--28">Favorits Page, je suis !</h1>
            <div class="bXYfs--16 bXYcolor--g flex flex-center">
            <p style="width: 400px">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic
                asperiores voluptas ullam dolores consequatur? Vel
            </p>
            </div>
            <div class="q- q-mt-lg">
            <q-btn
                color="primary"
                icon="eva-chevron-left-outline"
                text-color="white"
                class="bXYcolor--white q-mr-lg bXYbtn"
                label="Button"
            />
            </div>
        </div>
        </div>
    </q-page>
</template>

<script>
import { defineComponent } from "vue";
import userData from 'local-storage'
import {useRouter, useRoute} from 'vue-router'
export default defineComponent({
    name: "Favorits",
    component: {},
    setup: () => {
        return{

        }
    }
});
</script>
