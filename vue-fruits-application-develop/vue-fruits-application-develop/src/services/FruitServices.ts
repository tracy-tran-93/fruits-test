import axios, { AxiosPromise } from 'axios'

const headers = {
  'Access-Control-Allow-Origin': '*'
}

class FruitServices {
  getAllFruits (params: any): AxiosPromise {
    return axios.get(`${process.env.VUE_APP_BASE_API}/api/fruit`, {
      headers,
      params
    })
  }
}

export default new FruitServices()
