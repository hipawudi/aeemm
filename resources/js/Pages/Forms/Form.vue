<template>
  <MemberLayout title="Dashboard" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">表格列表</h2>
    </template>
    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-40" v-if="left">
        <div
          class="flex flex-row sm:flex-col p-2 pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
        >
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'all' ? 'text-blue' : 'text-black'"
              @click="searchCourse('all')"
              >全部課程</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'new' ? 'text-blue' : 'text-black'"
              @click="searchCourse('new')"
              >新課程</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'old' ? 'text-blue' : 'text-black'"
              @click="searchCourse('old')"
              >舊課程</a
            >
          </div>
        </div>
      </div>
      <div
        class="flex-none flex justify-center -mt-2 sm:h-screen sticky"
        :class="left ? 'top-[10.5rem]' : 'top-[6.75rem]'"
      >
        <div
          class="bg-white w-10 h-12 rounded-r-full flex justify-center items-center sticky sm:top-[50vh] sm:-left-2 rotate-90 sm:rotate-0 text-center"
        >
          <a v-if="left" @click="closeLeft()"
            ><img src="images/icons/right.png" class="w-6 h-6 hover:scale-105 rotate-180"
          /></a>
          <a v-if="!left" @click="openLeft()"
            ><img src="images/icons/right.png" class="w-6 h-6 hover:scale-105"
          /></a>
        </div>
      </div>
      <div class="flex-auto mx-auto max-w-6xl pt-2" v-if="forms.total">
        <div
          class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
        >
          <a-table :dataSource="forms" :columns="columns">
            <template #bodyCell="{ column, text, record, index }">
              <template v-if="column.dataIndex == 'operation'">
                資料欄位
                <inertia-link
                  :href="route('forms.show', record.id)"
                  class="float-right text-red-500"
                  >Apply</inertia-link
                >
              </template>
              <template v-else>
                {{ record[column.dataIndex] }}
              </template>
            </template>
          </a-table>
        </div>
      </div>
    </div>
  </MemberLayout>
  <WebLayout title="Dashboard" v-else>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">表格列表</h2>
    </template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div
        class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <a-table :dataSource="forms" :columns="columns">
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.dataIndex == 'operation'">
              資料欄位
              <inertia-link
                :href="route('forms.show', record.id)"
                class="float-right text-red-500"
                >Apply</inertia-link
              >
            </template>
            <template v-else>
              {{ record[column.dataIndex] }}
            </template>
          </template>
        </a-table>
      </div>
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
          title: "Name",
          dataIndex: "name",
        },
        {
          title: "Title",
          dataIndex: "title",
        },
        {
          title: "description",
          dataIndex: "description",
          width: "45%",
        },
        {
          title: "Action",
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
