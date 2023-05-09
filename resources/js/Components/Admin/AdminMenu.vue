<template>
  <div>
    <a-menu v-model:selectedKeys="selectedKeys" mode="inline" theme="light">
      <a-menu-item v-for="am in adminMenu" :key="am.key"
        ><template #icon>
          <component :is="am.icon" />
        </template>
        <inertia-link :href="route(am.route)" :target="am.target">{{
          am.title
        }}</inertia-link>
      </a-menu-item>
    </a-menu>
  </div>
</template>
<script>
import { reactive, toRefs, watch, ref } from "vue";
import {
  MenuFoldOutlined,
  FormOutlined,
  UserOutlined,
  MenuUnfoldOutlined,
  FileTextOutlined,
  PieChartOutlined,
  BookOutlined,
  MessageOutlined,
  MailOutlined,
  DesktopOutlined,
  InboxOutlined,
  NotificationOutlined,
  AppstoreOutlined,
} from "@ant-design/icons-vue";

export default {
  components: {
    MenuFoldOutlined,
    MenuUnfoldOutlined,
    PieChartOutlined,
    MailOutlined,
    MessageOutlined,
    BookOutlined,
    FileTextOutlined,
    UserOutlined,
    FormOutlined,
    NotificationOutlined,
    DesktopOutlined,
    InboxOutlined,
    AppstoreOutlined,
  },
  props: ["organization"],
  setup() {
    const adminMenu = ref([
      {
        key: "index",
        icon: "pie-chart-outlined",
        title: "主頁",
        route: "admin.index",
      },
      {
        key: "members",
        icon: "user-outlined",
        title: "會員",
        route: "admin.members.index",
      },
      {
        key: "certificates",
        icon: "inbox-outlined",
        title: "專業認證",
        route: "admin.certificates.index",
      },
      {
        key: "professionals",
        icon: "inbox-outlined",
        title: "專業證書",
        route: "admin.professionals.index",
      },
      {
        key: "forms",
        icon: "form-outlined",
        title: "表格",
        route: "admin.forms.index",
      },
      {
        key: "courses",
        icon: "book-outlined",
        title: "課程",
        route: "admin.courses.index",
      },
      {
        key: "messages",
        icon: "message-outlined",
        title: "通信",
        route: "admin.messages.index",
      },
      {
        key: "bulletins",
        icon: "notification-outlined",
        title: "公告",
        route: "admin.bulletins.index",
      },
    ]);
    return {
      adminMenu,
    };
  },
  data() {
    return {
      openKeys: [],
      selectedKeys: [],
    };
  },
  mounted() {
    console.log(route().current().split(".").slice(1, 2).join("."));
    this.openKeys.push(route().current().split(".")[1]);
    this.selectedKeys.push(route().current().split(".").slice(1, 2).join("."));
  },
};
</script>
