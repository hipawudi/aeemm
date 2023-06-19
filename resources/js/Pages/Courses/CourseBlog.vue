<template>
  <MemberLayout title="Dashboard" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程列表</h2>
    </template>

    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-10" v-if="left">
        <div
          class="flex flex-row sm:flex-col p-2 sm:pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
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
      <div class="flex-auto mx-auto max-w-6xl pt-2" v-if="courses.total">
        <div class="flex flex-col sm:grid lg:grid-cols-3 md:grid-cols-2 gap-6">
          <template v-for="course in courses.data">
            <div class="container mx-auto pt-4 w-auto">
              <div class="bg-white rounded-md">
                <div class="flex flex-col">
                  <img
                    :src="course.url ?? '/images/aeemm_banner.jpg'"
                    class="w-80 h-40 rounded-md"
                  />
                  <div class="flex flex-col p-4 gap-3">
                    <div class="text-xl font-bold">
                      {{ course.name_zh ?? course.name_en }}
                    </div>
                    <div class="text-sm text-gray-500">
                      報名時間:{{ course.start_date }}至{{ course.end_date }}
                    </div>
                    <div class="flex">
                      <div class="flex-auto space-x-2 flex items-center">
                        <img src="/images/icons/dollar.png" class="w-6 h-6" />
                        <div v-if="!course.member_priority">
                          {{ "非會員:" + course.fee }}
                        </div>
                        <div>會員:{{ course.fee_member }}</div>
                      </div>
                      <div class="flex-auto space-x-2 flex items-center">
                        <img src="/images/icons/clock.png" class="w-6 h-6" />
                        <div>{{ course.hours }}小時</div>
                      </div>
                    </div>
                    <div class="flex">
                      <div class="flex-auto text-center">
                        <inertia-link :href="route('forms.show', course.id)">
                          <a-button
                            :disabled="
                              new Date(course.end_date) < new Date() ||
                              course.form.published == 0
                            "
                            type="primary"
                            shape="round"
                            >立即報名</a-button
                          >
                        </inertia-link>
                      </div>
                      <div class="flex-auto text-center">
                        <inertia-link :href="route('courses.show', course.id)">
                          <a-button shape="round">了解更多</a-button></inertia-link
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
        <div class="my-6 text-right">
          <a-pagination
            v-model:current="courses.current_page"
            :total="courses.total"
            :page-size="courses.per_page"
            :page-size-options="pageSizeOptions"
            @change="changePage"
          />
        </div>
      </div>
      <div
        class="flex-auto mx-auto max-w-6xl pt-2 flex items-center justify-center"
        v-else
      >
        <a-empty
          image="https://gw.alipayobjects.com/mdn/miniapp_social/afts/img/A*pevERLJC9v0AAAAAAAAAAABjAQAAAQ/original"
          :image-style="{
            height: '300px',
          }"
        >
          <template #description>
            <div class="text-xl">沒有課程</div>
          </template>
        </a-empty>
      </div>
    </div>
  </MemberLayout>
  <WebLayout title="Dashboard" v-else>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程列表</h2>
    </template>
    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-10" v-if="left">
        <div
          class="flex flex-row sm:flex-col p-2 sm:pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
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
      <div class="flex-auto mx-auto max-w-6xl pt-2" v-if="courses.total">
        <div class="flex flex-col sm:grid lg:grid-cols-3 md:grid-cols-2 gap-6">
          <template v-for="course in courses.data">
            <div class="container mx-auto pt-4 w-auto">
              <div class="bg-white rounded-md">
                <div class="flex flex-col">
                  <img
                    :src="course.url ?? '/images/aeemm_banner.jpg'"
                    class="w-80 h-40 rounded-md"
                  />
                  <div class="flex flex-col p-4 gap-3">
                    <div class="text-xl font-bold">
                      {{ course.name_zh ?? course.name_en }}
                    </div>
                    <div class="text-sm text-gray-500">
                      報名時間:{{ course.start_date }}至{{ course.end_date }}
                    </div>
                    <div class="flex">
                      <div class="flex-auto space-x-2 flex items-center">
                        <img src="/images/icons/dollar.png" class="w-6 h-6" />
                        <div>
                          {{ course.member_priority ? "" : "非會員:" + course.fee }}
                        </div>
                        <div>會員:{{ course.fee_member }}</div>
                      </div>
                      <div class="flex-auto space-x-2 flex items-center">
                        <img src="/images/icons/clock.png" class="w-6 h-6" />
                        <div>{{ course.hours }}小時</div>
                      </div>
                    </div>
                    <div class="flex">
                      <div class="flex-auto text-center">
                        <a-button
                          :disabled="
                            new Date(course.end_date) < new Date() ||
                            course.form.published == 0
                          "
                          type="primary"
                          shape="round"
                          >立即報名</a-button
                        >
                      </div>
                      <div class="flex-auto text-center">
                        <inertia-link :href="route('courses.show', course.id)">
                          <a-button shape="round">了解更多</a-button>
                        </inertia-link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>

        <div class="my-6 text-right">
          <a-pagination
            v-model:current="courses.current_page"
            :total="courses.total"
            :page-size="courses.per_page"
            :page-size-options="pageSizeOptions"
            @change="changePage"
          />
        </div>
      </div>
      <div
        class="flex-auto mx-auto max-w-6xl pt-2 flex items-center justify-center"
        v-else
      >
        <a-empty
          image="https://gw.alipayobjects.com/mdn/miniapp_social/afts/img/A*pevERLJC9v0AAAAAAAAAAABjAQAAAQ/original"
          :image-style="{
            height: '300px',
          }"
        >
          <template #description>
            <div class="text-xl">沒有課程</div>
          </template>
        </a-empty>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import { SettingOutlined, EditOutlined, EllipsisOutlined } from "@ant-design/icons-vue";
import { Inertia } from "@inertiajs/inertia";
import { message } from "ant-design-vue";

export default {
  components: {
    MemberLayout,
    WebLayout,
    SettingOutlined,
    EditOutlined,
    EllipsisOutlined,
  },
  props: ["courses", "category"],
  setup() {},
  data() {
    return {
      loading: false,
      left: true,
      remove: "",
      page: 1,
      previousScrollTop: 0,
      pageSizeOptions: ["9", "18", "27", "36"],
    };
  },
  mounted() {
    if (this.$page.props.errors.message) {
      message.error(this.$page.props.errors.message);
    }
  },
  created() {
    // window.addEventListener("scroll", () => {
    //   const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
    //   if (
    //     scrollTop > this.previousScrollTop &&
    //     scrollTop + clientHeight >= scrollHeight &&
    //     !this.loading
    //   ) {
    //     this.loading = true;
    //     this.page++;
    //     this.previousScrollTop = scrollTop;
    //     // 發送 AJAX 請求加載數據
    //     this.$inertia.get(
    //       route("courses.index"),
    //       { page: this.page },
    //       {
    //         preserveScroll: true,
    //         preserveState: true,
    //         onSuccess: (visit) => {
    //           this.loading = false;
    //         },
    //         onError: (error) => {
    //           this.loading = false;
    //         },
    //       }
    //     );
    //   }
    // });
  },
  methods: {
    searchCourse(category) {
      console.log(this.courses.current_page);
      this.$inertia.get(
        route("courses.index"),
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
    changePage(page, pageSize) {
      this.$inertia.get(
        route("courses.index"),
        { category: this.category, page: page, per_page: pageSize },
        {
          preserveScroll: false,
          preserveState: false,
          onSuccess: (visit) => {
            this.loading = false;
          },
          onError: (error) => {
            this.loading = false;
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
