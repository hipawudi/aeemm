<template>
  <MemberLayout title="Dashboard" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名列表</h2>
    </template>
    <div class="max-w-7xl mx-auto mt-6 flex flex-col gap-3">
      <template v-for="a in applications">
        <div
          class="m-2 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
        >
          <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex items-center gap-3 sm:w-1/3">
              <div class="flex-auto sm:flex-none text-lg font-bold">
                {{ a.form.title }}
              </div>
              <div class="">
                <div
                  class="p-1 px-2 rounded-md text-green-500 bg-green-100 border border-solid border-green-500"
                >
                  {{ states.find((x) => x.value == a.state).label }}
                </div>
              </div>
            </div>
            <div class="flex items-center text-base sm:w-1/3">
              已提交報名申請,請等待工作人員審批
            </div>
            <div class="flex items-center justify-end sm:w-1/3 gap-3">
              <div v-if="a.state == 0">
                <inertia-link :href="route('applications.show')">
                  <a-button type="primary" shape="round">查看</a-button>
                </inertia-link>
              </div>
              <div v-if="a.state == 1">
                <a-button type="primary" shape="round">提交繳費單</a-button>
              </div>
            </div>
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
  props: ["applications", "states"],
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
