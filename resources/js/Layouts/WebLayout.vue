<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import WebMenu from "@/Components/WebMenu.vue";

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

// const switchToTeam = (team) => {
//     Inertia.put(route('current-team.update'), {
//         team_id: team.id,
//     }, {
//         preserveState: false,
//     });
// };

const logout = () => {
  Inertia.post(route("logout"));
};
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100 sticky w-full z-50 top-0">
        <!-- Primary Navigation Menu -->
        <div class="px-4 sm:px-12">
          <div class="flex h-16">
            <div class="flex-auto flex justify-start">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('index')">
                  <img src="/images/aeemm_logo.jpg" style="width: 64px" />
                </Link>
              </div>
              <div class="hidden sm:flex">
                <WebMenu />
              </div>
            </div>
            <div class="flex-auto flex justify-end">
              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <NavLink :href="route('login')"> Login </NavLink>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow sticky w-full z-50 top-16">
        <div class="px-4 py-2 sm:px-12">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
