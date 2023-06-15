<template>
  <a-menu v-model:selectedKeys="current" mode="horizontal">
    <template v-for="item in menuItems">
      <a-menu-item :key="item.key" v-if="item.role">
        <template #icon>
          <component :is="item.icon" />
        </template>
        <inertia-link :href="route(item.route)">{{ item.title }}</inertia-link>
      </a-menu-item>
    </template>
  </a-menu>
</template>
<script>
import { defineComponent, ref } from "vue";
import {
  HomeOutlined,
  VerifiedOutlined,
  AppstoreOutlined,
  IdcardOutlined,
  BankOutlined,
  EditOutlined,
  SettingOutlined,
} from "@ant-design/icons-vue";
export default defineComponent({
  components: {
    HomeOutlined,
    VerifiedOutlined,
    AppstoreOutlined,
    IdcardOutlined,
    BankOutlined,
    EditOutlined,
    SettingOutlined,
  },
  setup() {
    const current = ref(["dashboard"]);
    const menuItems = ref([
      {
        key: "courses.index",
        icon: "bank-outlined",
        title: "課程",
        route: "courses.index",
        role: true,
      },
    ]);
    return {
      current,
      menuItems,
    };
  },
  created() {
    this.current[0] = route().current();
  },
});
</script>

<style>
.ant-menu-root {
  padding-top: 10px;
}

.ant-menu-title-content {
  padding-top: 5px !important;
}
</style>
