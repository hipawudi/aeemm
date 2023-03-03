<template>
    <a-layout class="h-full">
        <a-layout-sider v-model:collapsed="collapsed" :trigger="null" collapsible
        >
            <div class="logo" >MPU</div>
            <AdminMenu />
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0" class="flex">
                <menu-unfold-outlined v-if="collapsed" class="trigger" @click="() => (collapsed = !collapsed)" />
                <menu-fold-outlined v-else class="trigger" @click="() => (collapsed = !collapsed)" />

                <div class="flex-1"></div>

                <a-dropdown placement="bottomRight">
                    <a class="trigger" @click.prevent>
                        {{ $page.props.currentUser.name }}
                    </a>
                    <template #overlay>
                        <a-menu>
                            <a-menu-item>
                                <a href="javascript:;">我的資料</a>
                            </a-menu-item>
                            <a-menu-divider />
                            <a-menu-item>
                                <a href="javascript:;">教師平臺</a>
                            </a-menu-item>
                            <a-menu-item>
                                <a href="javascript:;">行政管理後臺</a>
                            </a-menu-item>
                            <a-menu-item>
                                <a href="javascript:;">登出</a>
                            </a-menu-item>
                        </a-menu>
                    </template>
                </a-dropdown>
            </a-layout-header>

            <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }">
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
            <main>
              <slot />
            </main>


            </a-layout-content>
        </a-layout>
    </a-layout>
  </template>

  <script setup>
  import { ref } from 'vue';
  import { Inertia } from '@inertiajs/inertia';

  import {
    MenuUnfoldOutlined,
    MenuFoldOutlined,
  } from '@ant-design/icons-vue';

  import AdminMenu from '@/Components/Admin/AdminMenu.vue';



  defineProps({
    title: String,
  });

  const showingNavigationDropdown = ref(false);
  const selectedKeys= ref(['1']);
  const collapsed= ref(false);

  const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
  };

  const logout = () => {
    Inertia.post(route('logout'));
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
