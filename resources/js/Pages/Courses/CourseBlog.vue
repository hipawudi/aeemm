<template>
  <MemberLayout title="Dashboard" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程列表</h2>
    </template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="card bg-white">aaa</div>
      <!-- <div
        class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <inertia-link v-for="course in courses" :href="'course/' + course.id">
          <a-card hoverable>
            <template #cover>
              <img
                alt="example"
                src="https://gw.alipayobjects.com/zos/rmsportal/JiqGstEfoWAOHiTxclqi.png"
              />
            </template>
            <template #actions>
              <setting-outlined key="setting" />
              <edit-outlined key="edit" />
              <ellipsis-outlined key="ellipsis" />
            </template>
            <a-card-meta :title="course.title_zh" :description="course.description_zh">
            </a-card-meta>
          </a-card>
        </inertia-link>
      </div> -->
    </div>
  </MemberLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import { SettingOutlined, EditOutlined, EllipsisOutlined } from "@ant-design/icons-vue";

export default {
  components: {
    MemberLayout,
    WebLayout,
    SettingOutlined,
    EditOutlined,
    EllipsisOutlined,
  },
  props: ["courses"],
  data() {
    return {};
  },
  created() {},
  methods: {},
};
</script>
