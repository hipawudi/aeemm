<template>
  <div>
    <a-menu
      v-model:selectedKeys="selectedKeys"
      :open-keys="openKeys"
      mode="inline"
      theme="light"
    >
      <template v-for="am in adminMenu" :key="am.key">
        <template v-if="!am.children">
          <a-menu-item :key="am.key">
            <template #icon>
              <component :is="am.icon" />
            </template>
            <inertia-link :href="route(am.route)" :target="am.target">{{
              am.title
            }}</inertia-link>
          </a-menu-item>
        </template>
        <template v-else>
          <a-sub-menu :key="am.key">
            <template #icon>
              <component :is="am.icon" />
            </template>
            <template #title>{{ am.title }}</template>
            <template v-for="item in am.children" :key="item.key">
              <template v-if="!item.children">
                <a-menu-item :key="item.key">
                  <template #icon>
                    <PieChartOutlined />
                  </template>
                  <inertia-link :href="route(item.route)" :target="item.target">
                    {{ item.title }}</inertia-link
                  >
                </a-menu-item>
              </template>
            </template>
          </a-sub-menu>
        </template>
      </template>
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
        children: [
          { key: "members.index", title: "會員列表", route: "admin.members.index" },
          {
            key: "members.payments.index",
            title: "會員繳費",
            route: "admin.members.payments.index",
          },
          {
            key: "members.applications.index",
            title: "會員申請",
            route: "admin.members.applications.index",
          },
        ],
      },
      {
        key: "certificates.index",
        icon: "inbox-outlined",
        title: "專業認證",
        route: "admin.certificates.index",
      },
      {
        key: "professionals.index",
        icon: "inbox-outlined",
        title: "專業證書",
        route: "admin.professionals.index",
      },
      {
        key: "forms.index",
        icon: "form-outlined",
        title: "表格",
        route: "admin.forms.index",
      },
      {
        key: "courses.index",
        icon: "book-outlined",
        title: "課程",
        route: "admin.courses.index",
      },
      {
        key: "messages.index",
        icon: "message-outlined",
        title: "通信",
        route: "admin.messages.index",
      },
      {
        key: "emails",
        icon: "mail-outlined",
        title: "電郵",
        route: "admin.emails.index",
        children: [
          { key: "emails.index", title: "電郵記錄", route: "admin.emails.index" },
          {
            key: "emails.create",
            title: "電郵發送",
            route: "admin.emails.create",
          },
        ],
      },
      {
        key: "bulletins.index",
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
    this.openKeys.push(route().current().split(".").slice(1, 2).join("."));
    this.selectedKeys.push(route().current().split(".").slice(1).join("."));
  },
};
</script>
