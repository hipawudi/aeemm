<template>
  <a-layout style="min-height: 100vh">
    <a-layout-sider
      v-model:collapsed="collapsed"
      :trigger="null"
      collapsible
      theme="light"
      width="250px"
      class="shadow-md"
    >
      <div class="m-4 text-center text-lg text-clip" v-if="collapsed">
        <inertia-link :href="route('admin.index')">AEEM..</inertia-link>
      </div>
      <div class="m-4 text-center text-lg text-clip" v-else>
        <inertia-link :href="route('admin.index')">AEEMM</inertia-link>
      </div>

      <AdminMenu :menuKeys="menuKeys" />
    </a-layout-sider>

    <a-layout>
      <a-layout-header
        class="shadow-md border-b-2 border-red-600 flex"
        style="background: #fff; padding: 0"
      >
        <menu-unfold-outlined
          v-if="collapsed"
          class="trigger"
          @click="() => (collapsed = !collapsed)"
        />
        <menu-fold-outlined
          v-else
          class="trigger"
          @click="() => (collapsed = !collapsed)"
        />

        <div class="flex-1"></div>

        <a-dropdown placement="bottomRight">
          <a class="trigger" @click.prevent>
            <!-- {{ $page.props.currentUser.roles }} -->
            {{ $page.props.user.name }}
          </a>
          <template #overlay>
            <a-menu>
              <a-menu-item>
                <a href="javascript:;">我的資料</a>
              </a-menu-item>
              <a-menu-divider />
              <a-menu-item @click="logout">
                <a>登出</a>
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </a-layout-header>

      <a-layout-content>
        <PageHeader v-if="$slots.header" :menuKeys="menuKeys">
          <template #header>
            <div>
              <slot name="header" />
            </div>
          </template>
        </PageHeader>

        <div class="mx-6">
          <main class="px-4">
            <slot />
          </main>
        </div>
      </a-layout-content>
    </a-layout>
  </a-layout>
</template>

<script setup>
import { ref, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import PageHeader from "@/Components/Admin/PageHeader.vue";

import { MenuUnfoldOutlined, MenuFoldOutlined } from "@ant-design/icons-vue";

import AdminMenu from "@/Components/Admin/AdminMenu.vue";

defineProps({
  title: String,
});

const menuKeys = reactive({
  menuOpenKey: "",
  menuSelectKey: "",
});

const showingNavigationDropdown = ref(false);
const selectedKeys = ref(["1"]);
const collapsed = ref(false);

const switchToTeam = (team) => {
  Inertia.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  Inertia.post(route("logout"));
};
</script>

<style>
#app .trigger {
  font-size: 18px;
  line-height: 64px;
  padding: 0 24px;
  cursor: pointer;
  transition: color 0.3s;
}

#app .trigger:hover {
  color: #1890ff;
}

#app .logo {
  height: 32px;
  background: rgba(255, 255, 255, 0.3);
  margin: 16px;
}

.site-layout .site-layout-background {
  background: #fff;
}
</style>
