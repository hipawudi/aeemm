<template>
  <MemberLayout title="Dashboard" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名列表</h2>
    </template>
    <div class="max-w-7xl mx-auto">
      <template v-for="a in applications">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
          <div class="flex flex-col">
            <div class=""></div>
            <div class=""></div>
            <div class=""></div>
          </div>
        </div>
      </template>
    </div>
  </MemberLayout>
  <WebLayout title="Dashboard" v-else>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名列表</h2>
    </template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div
        class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      ></div>
    </div>
  </WebLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";

export default {
  components: {
    MemberLayout,
    WebLayout,
  },
  props: ["forms"],
  data() {
    return {
      left: true,
      columns: [
        {
          title: "報名表名稱",
          dataIndex: "form_id",
        },
        {
          title: "狀態",
          dataIndex: "state",
        },
        {
          title: "備註",
          dataIndex: "remark",
          width: "45%",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        field: { required: true },
        label: { required: true },
      },
      validateMessages: {
        required: "${label} is required!",
        types: {
          email: "${label} is not a valid email!",
          number: "${label} is not a valid number!",
        },
        number: {
          range: "${label} must be between ${min} and ${max}",
        },
      },
      labelCol: {
        style: {
          width: "150px",
        },
      },
    };
  },
  created() {},
  methods: {},
};
</script>
