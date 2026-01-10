import { ref } from "vue";

let sidebarDefault = ref(true);
let sidebarToggling = function () {
  sidebarDefault.value = !sidebarDefault.value;
};

export { sidebarDefault, sidebarToggling };
