<template>
  <header
    class="bg-white fixed top-0 left-0 w-full z-[9999] border-b border-solid border-[#ddd]"
  >
    <div class="max-w-[800px] mx-auto px-4">
      <div class="flex justify-between items-center h-20 gap-4">
        <!-- Logo -->
        <router-link
          class="h-full flex items-center justify-center flex-shrink-0 relative -left-[30px]"
          :to="{ name: 'home' }"
        >
          <img
            src="@/assets/images/page-logo.png"
            alt="Page logo"
            class="max-h-full object-contain"
          />
        </router-link>

        <!-- Search input -->
        <el-input
          :disabled="$route.name !== 'home'"
          class="max-w-[400px] -left-9"
          placeholder="Search fruits"
          v-model="fruitSearch"
          v-debounce="updateSearch"
        ></el-input>

        <!-- Go to favorite page -->
        <router-link
          :to="{ name: 'favorite' }"
          class="w-[40px] h-[40px] bg-[#EAF1EE] rounded-[12px] !rounded-br-[20px] flex items-center justify-center flex-shrink-0 hover:!rounded-[12px]"
        >
          <div class="relative">
            <div
              v-if="$store.state?.favorite?.listFavorite.length"
              class="text-[#347758] text-[14px] absolute bottom-5 left-5 w-[20px] h-[20px] bg-[#F4C340] text-center rounded-full"
            >
              {{ $store.state?.favorite?.listFavorite.length }}
            </div>
            <font-awesome-icon icon="fa-regular fa-heart" />
          </div>
        </router-link>
      </div>
    </div>
  </header>
</template>

<script lang="ts">
import { Component, Vue, Watch } from 'vue-property-decorator'

@Component({
  components: {}
})
export default class Header extends Vue {
  public fruitSearch = '';

  // clear value search when change route
  @Watch('$route')
  watchRouteChange () {
    this.fruitSearch = ''
  }

  updateSearch () {
    this.$emit('update-query-search', this.fruitSearch)
  }
}
</script>
