<template>
  <AdminLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
    </template>
    <div class="flex flex-col gap-6">
      <div class="text-2xl font-bold">{{ title }}</div>
      <div class="grid grid-cols-2 gap-8 xl:grid-cols-4">
        <div class="card bg-white rounded-md h-36">
          <div class="flex h-full">
            <div class="hidden lg:flex items-center justify-center w-2/5 pl-6">
              <img src="/images/member.png" class="h-24" />
            </div>
            <div class="flex flex-col justify-center items-start w-full p-4">
              <div class="text-4xl text-gray-600">{{ membersCount }}</div>
              <div class="text-lg text-gray-500">會員數量</div>
            </div>
          </div>
        </div>
        <div class="card bg-white rounded-md h-36">
          <div class="flex h-full">
            <div class="hidden lg:flex items-center justify-center w-2/5 pl-6">
              <img src="/images/book.png" class="h-24" />
            </div>
            <div class="flex flex-col justify-center items-start w-full p-4">
              <div class="text-4xl text-gray-600">{{ coursesCount }}</div>
              <div class="text-lg text-gray-500">課程數量</div>
            </div>
          </div>
        </div>
        <div class="card bg-white rounded-md h-36">
          <div class="flex h-full">
            <div class="hidden lg:flex items-center justify-center w-2/5 pl-6">
              <img src="/images/cpa.png" class="h-24" />
            </div>
            <div class="flex flex-col justify-center items-start w-full p-4">
              <div class="text-4xl text-gray-600">{{ professionalsCount }}</div>
              <div class="text-lg text-gray-500">證書數量</div>
            </div>
          </div>
        </div>
        <div class="card bg-white rounded-md h-36">
          <div class="flex h-full">
            <div class="hidden lg:flex items-center justify-center w-2/5 pl-6">
              <img src="/images/bulletin.png" class="h-24" />
            </div>
            <div class="flex flex-col justify-center items-start w-full p-4">
              <div class="text-4xl text-gray-600">{{ bulletinsCount }}</div>
              <div class="text-lg text-gray-500">公告數量</div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex">
        <div class="flex flex-col gap-6">
          <div class="font-bold text-2xl">通知</div>
          <div class="bg-white rounded-lg p-4 flex flex-col gap-2">
            <div class="text-xl">會員申請</div>
            <div class="text-lg">
              有<span
                class="font-bold"
                :class="ApplicationMembersCount > 0 ? 'text-blue-500' : ''"
                >{{ ApplicationMembersCount }}</span
              >名用戶申請成為會員
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { FormOutlined } from "@ant-design/icons-vue";

export default {
  components: {
    AdminLayout,
    FormOutlined,
  },
  props: [
    "membersCount",
    "coursesCount",
    "professionalsCount",
    "bulletinsCount",
    "ApplicationMembersCount",
  ],
  data() {
    return {
      title: "早上好",
    };
  },
  created() {
    let today = new Date();
    let hour = today.getHours();
    if (hour >= 6 && hour < 12) {
      this.title = "早上好";
    } else if (hour >= 12 && hour < 18) {
      this.title = "下午好";
    } else {
      this.title = "晚上好";
    }
  },
  methods: {},
};
</script>
