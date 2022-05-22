import { RouteRecordRaw } from "vue-router";

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    component: () => import("layouts/IndexLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/Home.vue"),
      },

      {
        path: "/viewer",
        component: () => import("pages/childs/ViewerComponent.vue"),
        children: [
          {
            path: ":type",
            component: () => import("pages/childs/viewers/Viewer.vue"),
          },
          {
            path: "/viewer2/:type",
            component: () => import("pages/childs/viewers/Viewer2.vue"),
          },
        ],
      },

      { path: "paramettres", component: () => import("pages/Paramettres.vue") },
      {
        path: "auth",
        component: () => import("pages/Auth.vue"),
        children: [
          {
            path: "",
            component: () => import("pages/childs/auth/Login.vue"),
          },
          {
            path: "register",
            component: () => import("pages/childs/auth/Register.vue"),
          },
        ],
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/Error404.vue"),
  },
];

export default routes;
