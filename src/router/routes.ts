import { RouteRecordRaw } from "vue-router";

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    component: () => import("layouts/IndexLayout.vue"),
    children: [
      { path: "", component: () => import("pages/Home.vue") },
      {
        path: "livres",
        component: () => import("pages/Livres.vue"),
        children: [
          {
            path: "webviewer",
            component: () => import("pages/childs/livres/WebViewer.vue"),
          },
        ],
      },
      { path: "favorits", component: () => import("pages/Favorits.vue") },
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

  {
    path: "/admin",
    component: () => import("layouts/IndexLayout.vue"),
    children: [
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
      {
        path: "/admin/home",
        component: () => import("pages/admin/a.home.vue"),
      },
      {
        path: "/admin/addlivre",
        component: () => import("pages/admin/a.addlivre.vue"),
      },
      {
        path: "/admin/users",
        component: () => import("pages/admin/a.users.vue"),
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
