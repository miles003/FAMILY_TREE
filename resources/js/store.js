import axios from 'axios'
export const stores = {
  state: {
    user: {},
    father:{},
    mother:{},
    errors:{}
  },
  mutations: {
    SET_DATA(state, payload, type) {
      state.user = payload;
    }
  },
  actions: {
    SET_DATA({ commit }, payload) {
      commit('SET_DATA', payload);
    },
    async getUserData({commit}){
      const urlSearchParams = new URLSearchParams(window.location.search);
      const params = Object.fromEntries(urlSearchParams.entries());
      let response = await axios.get('/api/users',{params:params})
      commit('SET_DATA', response.data);
    },
  },
  getters : {
    userData: state => state.user,
    fatherData: state => state.father,
    motherData: state => state.mother,
    authenticated: state => state.user.id ? state.user.id === state.user.authenticated_id : false
  }
}