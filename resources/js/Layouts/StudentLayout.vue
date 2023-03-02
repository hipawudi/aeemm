<template>
    <a-layout style="min-height: 100vh">
        
        <a-layout-sider v-model:collapsed="collapsed" :trigger="null" collapsible theme="light" width="250px" class="shadow-md " >
            <StudentMenu :menuKeys='menuKeys' />
        </a-layout-sider>
        
        <a-layout>

            <!-- Top header -->
            <a-layout-header class=" !bg-white !p-0">
                <div class="py-4 px-8 text-lg">
                    <menu-unfold-outlined v-if="collapsed" class=" hover:text-blue-400" @click="() => (collapsed = !collapsed)" />
                    <menu-fold-outlined v-else class=" hover:text-blue-400" @click="() => (collapsed = !collapsed)" />
                </div>
            </a-layout-header>

            <a-layout-content :style="{ margin: '8px 10px', padding: '12px' }">

                <PageHeader v-if="$slots.header" :menuKeys='menuKeys'>
                    <template #header>
                        <div>
                            <slot name="header" />
                        </div>
                    </template>
                </PageHeader>

                <div class="mx-6">
                    <main>
                        <slot />
                    </main>
                </div>

            </a-layout-content>
        </a-layout>
    </a-layout>
</template>
  
<script setup>
import { ref, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import PageHeader from '@/Components/Student/PageHeader.vue';

import {
    MenuUnfoldOutlined,
    MenuFoldOutlined,
} from '@ant-design/icons-vue';

import StudentMenu from '@/Components/Student/StudentMenu.vue';

defineProps({
    title: String,
});

const menuKeys = reactive({
    menuOpenKey: '',
    menuSelectKey: ''
})

const showingNavigationDropdown = ref(false);
const selectedKeys = ref(['1']);
const collapsed = ref(false);

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
    
  