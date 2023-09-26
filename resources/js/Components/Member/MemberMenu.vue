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
  DollarCircleOutlined,
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
    DollarCircleOutlined,
  },
  setup() {
    const current = ref(["dashboard"]);
    const menuItems = ref([
      {
        key: "dashboard",
        icon: "home-outlined",
        title: "主頁",
        route: "dashboard",
        role: true,
      },
      {
        key: "professionals.index",
        icon: "verified-outlined",
        title: "專業認證",
        route: "professionals.index",
        role: true,
      },
      {
        key: "courses.index",
        icon: "bank-outlined",
        title: "課程",
        route: "courses.index",
        role: true,
      },
      {
        key: "applications.index",
        icon: "edit-outlined",
        title: "報名",
        route: "applications.index",
        role: true,
      },
      {
        key: "payments.index",
        icon: "dollar-circle-outlined",
        title: "會費",
        route: "payments.index",
        role: true,
      },
      {
        key: "admin.index",
        icon: "appstore-outlined",
        title: "行政管理",
        route: "admin.index",
        role: true,
      },
    ]);
    return {
      current,
      menuItems,
    };
  },
  created() {
    this.menuItems[5].role = this.$page.props.user.roles[0] == "admin";
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
