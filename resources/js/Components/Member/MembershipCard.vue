<script setup>
//import { defineProps } from "vue";

defineProps({
  title: String,
  card: Object,
});
</script>

<template>
  <div class="flex justify-center">
    <div class="relative py-4 w-96 hover:scale-105 transform transition-transform mb-4">
      <div
        class="absolute z-50 flex flex-col py-3 px-8 text-white shadow-xl text-sm font-serif w-96 h-52"
      >
        <div class="flex flex-col w-xl">
          <div class="flex justify-center">
            <div class="text-lg font-bold">澳門電腦學會</div>
          </div>
          <div class="flex">
            <div class="flex flex-col flex-auto gap-1">
              <div class="">姓名</div>
              <div class="mb-2">{{ card.name_zh }}</div>
              <div class="">學會編號</div>
              <div class="font-sans mb-2">
                {{ ("0000" + card.id.toString()).slice(-5) }}
              </div>
            </div>
            <div class="flex-auto text-right">
              <img class="w-14 h-14" src="/images/logo.jpg" />
            </div>
          </div>
        </div>
        <div class="flex text-xs">
          <div class="flex flex-col gap-1 flex-auto">
            <div class="">有效期</div>
            <div class="font-sans text-base">
              {{ new Date().getFullYear() + "-03-31" }}
            </div>
          </div>
          <div class="flex flex-col gap-1 flex-auto">
            <div class="">失效期</div>
            <div class="font-sans text-base">
              {{ new Date().getFullYear() + 1 + "-03-31" }}
            </div>
          </div>
        </div>
      </div>
      <img
        class="relative object-cover w-96 h-52 rounded-lg z-0"
        src="/images/card1.png"
        width="10px"
      />
    </div>
  </div>
  <!-- <div class="md:grid md:grid-cols-3 py-5 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div
        class="w-96 h-56 m-auto bg-red-100 rounded-lg relative text-white shadow-2xl transition-transform transform hover:scale-110"
      >
        <img
          class="relative object-cover w-full h-full rounded-lg"
          :src="card.face"
          width="10px"
        />
        <div class="absolute w-full text-center text-lg" style="top: 1em">
          {{ card.cert_title }}
        </div>
        <div class="w-full px-8 absolute top-8">
          <div class="flex justify-between">
            <div class="">
              <p class="font-light">Name</p>
              <p p class="font-medium tracking-widest">{{}}</p>
            </div>
            <img class="w-14 h-14" src="images/logo.png" />
          </div>
          <div class="grid grid-cols-2 gap-2">
            <div class="pt-1">
              <p class="font-light">編號</p>
              <p class="font-medium tracking-more-wider">
                {{ card }}
              </p>
            </div>
            <div class="pt-1">
              <p class="font-light">
                {{ card.rank_caption }}
              </p>
              <p class="font-medium tracking-more-wider">{{}}</p>
            </div>
          </div>

          <div class="pt-6 pr-6">
            <div class="flex justify-between">
              <div class="">
                <p class="font-light text-xs">Valid</p>
                <p class="font-medium tracking-wider text-sm">
                  {{ card }}
                </p>
              </div>
              <div class="">
                <p class="font-light text-xs">Expiry</p>
                <p class="font-medium tracking-wider text-sm">
                  {{ card }}
                </p>
              </div>

              <div class="">
                <p class="font-light text-xs">CVV</p>
                <p class="font-bold tracking-more-wider text-sm">···</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>

<style>
p {
  margin-bottom: 0;
}
</style>
