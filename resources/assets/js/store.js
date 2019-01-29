import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
//import { HTTP } from "./http-common"

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    status: '',
    token: localStorage.getItem('token') || '',
    user: {}
  },
  mutations: {
    auth_request(state) {
      state.status = 'loading'
    },
    auth_success(state, data) {
      state.status = 'success'
      state.token = data.token
      state.user = data.user
    },
    auth_error(state) {
      state.status = 'error'
    },
    logout(state) {
      state.status = ''
      state.token = ''
    }
  },
  actions: {
    login({ commit }, user) {
      return new Promise((resolve, reject) => {
        commit('auth_request')
        //axios({ url: 'http://localhost:3000/login', data: user, method: 'POST' })
        axios.post("/login", user)
          .then(resp => {
            const token = resp.data.success.token
            const user = resp.data.user

            localStorage.setItem('token', token)
            axios.defaults.headers.common['Authorization'] = 'Bearer '+token
            //console.log(user)
            commit('auth_success', { 'token': token, 'user': user })
            resolve(resp)
          })
          .catch(err => {
            commit('auth_error')
            localStorage.removeItem('token')
            reject(err)
          })
      })
    },
    register({ commit }, user) {
      return new Promise((resolve, reject) => {
        commit('auth_request')
        //axios({url: 'http://localhost:3000/register', data: user, method: 'POST' })
        axios.post("/register", user)
          .then(resp => {
            const token = resp.data.success.token
            const user = resp.data.user
            localStorage.setItem('token', token)
            axios.defaults.headers.common['Authorization'] = 'Bearer '+token
            commit('auth_success', { 'token': token, 'user': user })
            resolve(resp)
          })
          .catch(err => {
            commit('auth_error', err)
            localStorage.removeItem('token')
            reject(err)
          })
      })
    },
    logout({ commit }) {
      return new Promise((resolve, reject) => {
        commit('logout')
        localStorage.removeItem('token')
        delete axios.defaults.headers.common['Authorization']
        resolve()
      })
    }
  },
  getters: {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    User: state => state.user.name
  },



})