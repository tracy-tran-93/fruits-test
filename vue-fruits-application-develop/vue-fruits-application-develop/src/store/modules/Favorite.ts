import { CFruit } from '@/models'
import { Module, VuexModule, Mutation, Action } from 'vuex-module-decorators'

@Module({ name: 'favorite', namespaced: true })
class Favorite extends VuexModule {
  listFavorite: CFruit[] = [];

  @Mutation
  setListFavorite (newList: CFruit[]): void {
    this.listFavorite = newList
  }

  @Action({ rawError: true })
  SET_LIST_FAVORITE (newList: CFruit[]): void {
    this.context.commit('setListFavorite', newList)
  }
}

export default Favorite
