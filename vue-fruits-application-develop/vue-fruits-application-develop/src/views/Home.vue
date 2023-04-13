<template>
  <div class="home container flex flex-col flex-1 mt-10">
    <div v-if="loading" class="flex items-center justify-center min-h-[50vh]">
      <Loading />
    </div>

    <div
      v-if="!loading && listFruits.length"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-10"
    >
      <div v-for="fruit in listFruits" :key="fruit.id" class="fruit-item">
        <FruitItem :item="fruit" />
      </div>
    </div>

    <div v-if="!loading && !listFruits.length">No Fruit Found</div>

    <!-- Pagination -->
    <div
      v-if="!loading && listFruits.length"
      class="flex flex-1 items-end justify-center"
    >
      <el-pagination
        hide-on-single-page
        :current-page="page"
        @current-change="(newPage) => (page = newPage)"
        layout="prev, pager, next"
        :page-size="limit"
        :total="totalFruits"
      >
      </el-pagination>
    </div>
  </div>
</template>

<script lang="ts">
import { CFruit, UrlParams } from '@/models'
import { Component, Vue, Watch, Prop } from 'vue-property-decorator'
import FruitItem from '@/components/FruitItem.vue'
import Loading from '@/components/Loading.vue'
import FruitServices from '@/services/FruitServices'
import { AxiosResponse } from 'axios'

@Component({
  components: { FruitItem, Loading }
})
export default class Home extends Vue {
  @Prop() public querySearch!: string;
  public listFruits: CFruit[] = [];
  public totalFruits = 0;
  public page = 1;
  public limit = 12;
  public loading = true;

  @Watch('page')
  watchPageChange () {
    this.page = 1
    this.getListFruits()
  }

  @Watch('querySearch')
  watchQueryChange () {
    this.page = 1
    this.getListFruits()
  }

  getListFruits () {
    // params search
    const params: UrlParams = {
      page: this.page,
      limit: this.limit
    }

    if (this.querySearch) {
      params.query = this.querySearch
    }

    this.loading = true
    FruitServices.getAllFruits(params)
      .then((response: AxiosResponse) => {
        if (response.status === 200) {
          const { data } = response || {}
          this.listFruits = data?.fruits?.map((item: CFruit) => {
            return {
              ...item,
              image:
                'https://demo2.wpopal.com/ecolive/wp-content/uploads/2021/10/56-300x300.png'
            }
          })
          this.totalFruits = data?.total_records
        }
      })
      .catch((error) => console.log(error))
      .finally(() =>
        setTimeout(() => {
          this.loading = false
        }, 500)
      )
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth'
    })
  }

  created () {
    this.getListFruits()
  }
}
</script>
