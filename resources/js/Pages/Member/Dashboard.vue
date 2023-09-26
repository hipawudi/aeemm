<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";

export default {
  props: ["member", "messages"],
  components: { MemberLayout },
  data() {
    return {};
  },
  computed: {},
};
</script>

<template>
  <MemberLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">會員專區</h2>
    </template>
    <div class="container mx-auto">
      <div class="flex flex-col-reverse md:flex-row gap-6">
        <div class="flex-auto md:w-1/2">
          <div class="container mx-auto pt-5">
            <div class="bg-white relative shadow rounded-lg pl-5">
              <a-list item-layout="horizontal" :data-source="messages">
                <template #renderItem="{ item }">
                  <a-list-item>
                    <a-list-item-meta :description="item.content">
                      <template #title>
                        <div>{{ item.title }}</div>
                      </template>
                      <template #avatar>
                        <div class="flex flex-col">
                          <div class="text-center">
                            <a-avatar src="/images/logo.jpg" />
                          </div>
                          <div class="w-20 text-center">{{ item.send_date }}</div>
                        </div>
                      </template>
                    </a-list-item-meta>
                  </a-list-item>
                </template>
              </a-list>
            </div>
          </div>
        </div>
        <div class="flex-auto md:w-1/2">
          <div class="container mx-auto pt-5">
            <div class="bg-white relative shadow rounded-lg">
              <MembershipCard :card="$page.props.user.member">
                <template #description>
                  <div v-html="card.description"></div>
                </template>
              </MembershipCard>
              <div>
                <h3 class="font-medium text-gray-900 text-left px-6">近況</h3>
                <div
                  class="mt-5 w-full flex flex-col items-center overflow-hidden text-sm"
                >
                  <a
                    href="#"
                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"
                  >
                    <img
                      src="https://avatars0.githubusercontent.com/u/35900628?v=4"
                      alt=""
                      class="rounded-full h-6 shadow-md inline-block mr-2"
                    />
                    Updated his status
                    <span class="text-gray-500 text-xs">24 min ago</span>
                  </a>

                  <a
                    href="#"
                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"
                  >
                    <img
                      src="https://avatars0.githubusercontent.com/u/35900628?v=4"
                      alt=""
                      class="rounded-full h-6 shadow-md inline-block mr-2"
                    />
                    Added new profile picture
                    <span class="text-gray-500 text-xs">42 min ago</span>
                  </a>

                  <a
                    href="#"
                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"
                  >
                    <img
                      src="https://avatars0.githubusercontent.com/u/35900628?v=4"
                      alt=""
                      class="rounded-full h-6 shadow-md inline-block mr-2"
                    />
                    Posted new article in <span class="font-bold">#Web Dev</span>
                    <span class="text-gray-500 text-xs">49 min ago</span>
                  </a>

                  <a
                    href="#"
                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150"
                  >
                    <img
                      src="https://avatars0.githubusercontent.com/u/35900628?v=4"
                      alt=""
                      class="rounded-full h-6 shadow-md inline-block mr-2"
                    />
                    Edited website settings
                    <span class="text-gray-500 text-xs">1 day ago</span>
                  </a>

                  <a
                    href="#"
                    class="border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150 overflow-hidden"
                  >
                    <img
                      src="https://avatars0.githubusercontent.com/u/35900628?v=4"
                      alt=""
                      class="rounded-full h-6 shadow-md inline-block mr-2"
                    />
                    Added new rank
                    <span class="text-gray-500 text-xs">5 days ago</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MemberLayout>
</template>
<script setup>
import MembershipCard from "@/Components/Member/MembershipCard.vue";
</script>
