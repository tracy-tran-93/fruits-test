<template>
  <div
    class="group border-2 border-solid border-[#F2F2F2] rounded-[24px] p-6 bg-white hover:border-[#F4C340] transition-all h-full"
  >
    <div class="flex flex-col gap-2">
      <div class="relative pt-[10%]">
        <div class="relative pt-[100%]">
          <div class="absolute top-0 left-0 w-full h-full">
            <img
              :src="item.image"
              alt="Image"
              class="w-full max-h-full object-cover"
            />
          </div>
        </div>
        <div
          class="py-1 px-2 bg-[#f00] text-white text-[14px] absolute top-0 left-0 rounded-[10px]"
        >
          {{ item.family }}
        </div>
        <button
          class="py-1 px-2 border-2 border-solid border-[#ddd] text-black text-[20px] absolute top-0 right-0 rounded-full hidden group-hover:block"
          @click="addToFavorite()"
        >
          <font-awesome-icon
            :class="checkItemIsFavorite(item) ? 'text-[red]' : ''"
            :icon="[
              checkItemIsFavorite(item) ? 'fa-solid' : 'fa-regular',
              'fa-heart',
            ]"
          />
        </button>
      </div>
      <div class="'text-[#F4C340] text-[17px] font-[600]'">
        {{ item.name }}
      </div>
      <div :class="'text-[17px] font-[700]'">{{ item.order }}</div>
      <div class="text-[#BCBCBC]">
        Genus: <span class="text-black font-[500]">{{ item.genus }}</span>
      </div>
      <div class="flex flex-col gap-2">
        <span class="text-[#347758] font-[500]">{{
          `Carbonhydrates (${item.nutritions.carbohydrates})`
        }}</span>
        <div class="grid grid-cols-2 gap-2">
          <span class="text-[#347758] font-[500]">{{
            `Calories (${item.nutritions.calories})`
          }}</span>
          <span class="text-[#347758] font-[500]">{{
            `Sugar (${item.nutritions.sugar})`
          }}</span>
          <span class="text-[#347758] font-[500]">{{
            `Protein (${item.nutritions.protein})`
          }}</span>
          <span class="text-[#347758] font-[500]">{{
            `Fat (${item.nutritions.fat})`
          }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { CFruit } from '@/models'
import store from '@/store'
import Favorite from '@/store/modules/Favorite'
import { NotificationPosition } from 'element-ui/types/notification'
import { Component, Prop, Vue } from 'vue-property-decorator'
import { getModule } from 'vuex-module-decorators'

const FavoriteModule = getModule(Favorite, store)

@Component({
  components: {}
})
export default class FruitItem extends Vue {
  @Prop() public item!: CFruit;
  public notifcationPosition: NotificationPosition = 'bottom-right';

  addToFavorite () {
    let listFavorite: CFruit[] = this.$store.state.favorite.listFavorite
    const ids = listFavorite.map((item: CFruit) => item.id)

    if (!ids.includes(this.item.id)) {
      if (listFavorite.length < 10) {
        listFavorite.push(this.item)
        this.$notify({
          title: 'Notification',
          message: 'Add to favorite list successfully',
          position: this.notifcationPosition,
          type: 'success'
        })
      } else {
        this.$notify.info({
          title: 'Favorite list is full',
          message: 'Your favorite list is full. Please remove some item to add',
          position: this.notifcationPosition
        })
      }
    } else {
      listFavorite = listFavorite.filter(
        (element: CFruit) => element.id !== this.item.id
      )
      this.$notify({
        title: 'Notification',
        message: 'Remove from favorite list successfully',
        position: this.notifcationPosition,
        type: 'success'
      })
    }
    FavoriteModule.SET_LIST_FAVORITE(listFavorite)
  }

  checkItemIsFavorite (item: CFruit) {
    const listFavorite: CFruit[] = this.$store.state.favorite.listFavorite
    const ids = listFavorite.map((item: CFruit) => item.id)
    if (ids.includes(this.item.id)) {
      return true
    } else {
      return false
    }
  }
}
</script>
