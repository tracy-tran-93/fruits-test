<template>
  <div class="min-h-screen flex flex-col">
    <Header @update-query-search='updateQuerySearch' />
    <main class="flex flex-col flex-1 mt-20 mb-10">
      <Banner />
      <router-view :querySearch="querySearch"></router-view>
    </main>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Header from '@/components/Header.vue'
import Banner from '@/components/Banner.vue'

@Component({
  components: {
    Header,
    Banner
  }
})
export default class LayoutDefault extends Vue {
  public querySearch = ''

  updateQuerySearch (value: string) {
    this.querySearch = value
  }
}
</script>
