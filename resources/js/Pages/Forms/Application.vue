<template>
  <MemberLayout title="報名列表" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名列表</h2>
    </template>
    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-10" v-if="left">
        <div
          class="flex flex-row sm:flex-col p-2 sm:pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
        >
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'all' ? 'text-blue' : 'text-black'"
              @click="searchApplication('all')"
              >所有報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'new' ? 'text-blue' : 'text-black'"
              @click="searchApplication('new')"
              >待處理報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'old' ? 'text-blue' : 'text-black'"
              @click="searchApplication('old')"
              >待繳費報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'old' ? 'text-blue' : 'text-black'"
              @click="searchApplication('old')"
              >報名結果</a
            >
          </div>
        </div>
      </div>
      <div
        class="flex-none flex justify-center -mt-2 sm:h-[50vh] sticky"
        :class="left ? 'top-[9.45rem]' : 'top-[6.75rem]'"
      >
        <div
          class="bg-white w-10 h-12 rounded-r-full flex justify-center items-center sticky sm:top-[50vh] sm:-left-2 rotate-90 sm:rotate-0 text-center"
        >
          <a v-if="left" @click="closeLeft()"
            ><img
              src="/images/icons/right.png"
              class="w-6 h-6 hover:scale-105 rotate-180"
          /></a>
          <a v-if="!left" @click="openLeft()"
            ><img src="/images/icons/right.png" class="w-6 h-6 hover:scale-105"
          /></a>
        </div>
      </div>
      <div class="flex-auto mx-auto max-w-6xl pt-2">
        <template v-for="a in applications" :key="a.id">
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
                    class="p-1 px-2 rounded-md border border-solid"
                    :class="
                      a.state == 1
                        ? 'text-blue-500 bg-blue-100'
                        : a.state == 4
                        ? 'text-red-500 bg-red-100'
                        : 'text-green-500 bg-green-100'
                    "
                  >
                    {{ states.find((x) => x.value == a.state).label }}
                  </div>
                </div>
              </div>
              <div class="flex flex-auto items-center text-base sm:w-1/3">
                {{ states_message.find((x) => x.value == a.state).label }}
              </div>
              <div class="flex items-center justify-end gap-3">
                <div>
                  <inertia-link :href="route('courses.show', a.form.course_id)">
                    <a-button type="primary" ghost shape="round">查看課程</a-button>
                  </inertia-link>
                </div>
                <div>
                  <inertia-link :href="route('applications.show', a.id)">
                    <a-button type="primary" shape="round">查看</a-button>
                  </inertia-link>
                </div>
                <div v-if="a.state == 1">
                  <a-button
                    :type="a.state == 1 ? 'primary' : ''"
                    shape="round"
                    @click="openPayment(a)"
                    >提交繳費單</a-button
                  >
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </MemberLayout>
  <WebLayout title="報名列表" v-else>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名列表</h2>
    </template>
    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-10" v-if="left">
        <div
          class="flex flex-row sm:flex-col p-2 sm:pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
        >
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'all' ? 'text-blue' : 'text-black'"
              @click="searchApplication('all')"
              >所有報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'new' ? 'text-blue' : 'text-black'"
              @click="searchApplication('new')"
              >待處理報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'old' ? 'text-blue' : 'text-black'"
              @click="searchApplication('old')"
              >待繳費報名</a
            >
          </div>
          <div class="text-lg text-center flex-auto sm:flex-none">
            <a
              :class="category == 'old' ? 'text-blue' : 'text-black'"
              @click="searchApplication('old')"
              >報名結果</a
            >
          </div>
        </div>
      </div>
      <div
        class="flex-none flex justify-center -mt-2 sm:h-[50vh] sticky"
        :class="left ? 'top-[9.45rem]' : 'top-[6.75rem]'"
      >
        <div
          class="bg-white w-10 h-12 rounded-r-full flex justify-center items-center sticky sm:top-[50vh] sm:-left-2 rotate-90 sm:rotate-0 text-center"
        >
          <a v-if="left" @click="closeLeft()"
            ><img
              src="/images/icons/right.png"
              class="w-6 h-6 hover:scale-105 rotate-180"
          /></a>
          <a v-if="!left" @click="openLeft()"
            ><img src="/images/icons/right.png" class="w-6 h-6 hover:scale-105"
          /></a>
        </div>
      </div>
      <div class="flex-auto mx-auto max-w-6xl pt-2">
        <template v-for="a in applications" :key="a.id">
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
                    class="p-1 px-2 rounded-md border border-solid"
                    :class="
                      a.state == 1
                        ? 'text-blue-500 bg-blue-100'
                        : 'text-green-500 bg-green-100'
                    "
                  >
                    {{ states.find((x) => x.value == a.state).label }}
                  </div>
                </div>
              </div>
              <div class="flex items-center text-base sm:w-1/3">
                {{ states_message.find((x) => x.value == a.state).label }}
              </div>
              <div class="flex items-center justify-end sm:w-1/3 gap-3">
                <div v-if="a.state == 0">
                  <inertia-link :href="route('applications.show', a.id)">
                    <a-button type="primary" shape="round">查看</a-button>
                  </inertia-link>
                </div>
                <div v-if="a.state == 1">
                  <a-button type="primary" shape="round" @click="openPayment(a)"
                    >上傳繳費單</a-button
                  >
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </WebLayout>
  <a-modal v-model:visible="modal.isOpen" width="40%" :title="modal.title">
    <div class="flex flex-col gap-3">
      <div class="text-xl font-bold">上傳繳費單</div>
      <a-upload
        v-model:file-list="modal.payment"
        :multiple="false"
        :beforeUpload="() => false"
        :max-count="1"
        list-type="picture-card"
      >
        <a-button>
          <upload-outlined></upload-outlined>
          上傳
        </a-button>
      </a-upload>
    </div>
    <template #footer>
      <a-button @click="modal.isOpen = false">關閉</a-button>
      <a-button type="primary" @click="uploadPaymentImage(modal.data.id)">上傳</a-button>
    </template>
  </a-modal>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";

export default {
  components: {
    MemberLayout,
    WebLayout,
    UploadOutlined,
  },
  props: ["applications", "states", "states_message"],
  data() {
    return {
      modal: {
        isOpen: false,
        data: {
          title: "",
          payment: "",
        },
        title: "公告",
        mode: "",
      },
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
      category: "all",
      labelCol: {
        style: {
          width: "150px",
        },
      },
    };
  },
  created() {},
  methods: {
    openPayment(data) {
      console.log(data);
      this.modal.isOpen = true;
      this.modal.title = data.form.title;
      this.modal.data = data;
    },
    searchApplication(application) {
      console.log(this.courses.current_page);
      this.$inertia.get(
        route("applications.index"),
        { category: category ?? this.category },
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: (visit) => {
            console.log(this.courses);
            this.loading = false;
          },
          onError: (error) => {
            this.loading = false;
          },
        }
      );
    },
    uploadPaymentImage(application_id) {
      this.$inertia.post(
        route("applications.uploadPaymentImage", application_id),
        {
          payment: this.modal.payment,
        },
        {
          onSuccess: (page) => {
            this.modal.isOpen = false;
            message.success("上傳成功");
          },
          onError: (error) => {
            message.error(error.message);
          },
        }
      );
    },
    closeLeft() {
      this.left = false;
    },
    openLeft() {
      this.left = true;
    },
  },
};
</script>
