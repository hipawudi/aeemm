<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  hasLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Welcome" />
  <div
    class="relative flex flex-col items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
  >
    <div class="fixed top-0 right-0 px-6 py-4 mb-2 w-full text-right bg-white">
      <template v-if="$page.props.user.id">
        <template v-if="$page.props.user.roles.includes('visitor')">
          <Link
            :href="route('courses.index')"
            class="text-sm text-gray-700 dark:text-gray-500 underline"
            >課程</Link
          >
          <Link
            :href="route('forms.index')"
            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
            >報名</Link
          >
          <Link
            :href="route('member.application.create')"
            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
            >申請加入會員</Link
          >
        </template>
        <template v-else>
          <div class="flex space-x-2 justify-end">
            <Link
              v-if="$page.props.user.roles.includes('member')"
              :href="route('dashboard')"
              class="text-sm text-gray-700 dark:text-gray-500 underline"
              >會員專區</Link
            >
            <Link
              v-if="$page.props.user.roles.includes('admin')"
              :href="route('admin.index')"
              class="text-sm text-gray-700 dark:text-gray-500 underline"
            >
              行政管理
            </Link>
          </div>
        </template>
      </template>
      <template v-else>
        <Link
          :href="route('login')"
          class="text-sm text-gray-700 dark:text-gray-500 underline"
          >Log in</Link
        >
        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
          >Register</Link
        >
      </template>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <img src="/images/banner.jpg" />
      </div>
      <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="p-6">
            <div class="flex items-center">
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-8 h-8 text-gray-500"
              >
                <path
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="/" class="underline text-gray-900 dark:text-white">學會宗旨</a>
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                <ol style="padding-left: 15px; text-indent: -15px">
                  <li>
                    1.
                    加強本澳電機及機械工程專業人士的聯繫溝通及技術交流，並深化與本地及外地同類型組織的聯繫及合作藉以交流訊息及分享經驗，以提升本澳電機及機械工程的專業技術水平。
                  </li>
                  <li>
                    2.
                    加強會員們的團結及提高會員之專業技術水平，培訓本澳電機及機械工程人才，以推動電機及機械行業之發展。
                  </li>
                  <li>
                    3.
                    推廣電機及機械工程的普及教育及進行電機及械機工程之專業研究，以電機及機械專業技術服務社會及推動社會發展。
                  </li>
                  <li>
                    4.
                    加強與政府部門、社團及相關機構的合作交流，以提升電機及機械工程的專業地位。
                  </li>
                </ol>
              </div>
            </div>
          </div>

          <div
            class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"
          >
            <div class="flex items-center">
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-8 h-8 text-gray-500"
              >
                <path
                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                />
                <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="/" class="underline text-gray-900 dark:text-white"
                  >加入澳門機電工程師學會</a
                >
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                歡迎加入唯一在澳門機電工程技術範疇的專業學會，有了你們的加入，更可使本會在機電工程技術領域開拓更多的發展策略，並繼續履行所要肩負的宗旨及目標，共同為會員及業界推展澳門機電工程技術。我們深信在會員們的不懈努力下，機電工程專業方面在本地區將獲得更多的認受性及持續發展，並能與國際性的工程專業學會接軌，從而使會員們更易取得國際性認可的專業資格。
              </div>
            </div>
          </div>

          <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-8 h-8 text-gray-500"
              >
                <path
                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
                />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <a href="/" class="underline text-gray-900 dark:text-white">學會介紹</a>
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                本會融合在澳門特區政府內工程技術部門、專上學院、公用及專營企業、執業顧問事務所及營造承建企業從事電機及機械工程專業的工程師、承建商及工程技術人員所組成。透過政府機構、學術研究及業界的互動，本會希望建立一個提供本澳電機及機械工程人員進行提升專業技能及競爭能力的平臺。
              </div>
            </div>
          </div>

          <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
            <div class="flex items-center">
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-8 h-8 text-gray-500"
              >
                <path
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              <div
                class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"
              >
                Introduction of AEEMM
              </div>
            </div>

            <div class="ml-12">
              <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                Members of AEEMM are professional electrical or mechanical engineers
                working in Macao government technical department, academia, public
                utilities, consultancy and contractor. We hope to build a platform for E &
                M engineers in Macao to upgrade their professional technique, competitive
                and competence.
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left"></div>

        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
          Hubis @copyright2023
          <!-- Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }}) -->
        </div>
      </div>
    </div>
  </div>
</template>
