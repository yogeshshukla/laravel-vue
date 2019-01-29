<template>
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Assessment</a>
        </div>
        <ul class="nav navbar-nav">
          <li @click="setActive('Home')" :class="{active : isActive('Home')}">
            <router-link to="/vuelaravelcrud" class="nav-link">Home</router-link>
          </li>
          <li @click="setActive('create')" :class="{active : isActive('create')}">
            <router-link to="/vuelaravelcrud/create" class="nav-link">Create Post</router-link>
          </li>
          <li @click="setActive('posts')" :class="{active : isActive('posts')}">
            <router-link to="/vuelaravelcrud/posts" class="nav-link">Posts</router-link>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <template v-if="isLoggedIn">
            {{ userDetail }}
            <!-- {{ userDetail }} <span class="caret"></span>  -->
            <li class="dropdown">
              <a
                href="#"
                class="dropdown-toggle"
                data-toggle="dropdown"
                role="button"
                aria-expanded="false"
                aria-haspopup="true"
              >
                {{ user_name}}
                <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                <li>
                  <a @click="logout" href="javascript:void(0);">
                    <span class="glyphicon glyphicon-user"></span> Logout
                  </a>
                </li>
              </ul>
            </li>
          </template>
          <template v-else>
            <li>
              <router-link to="/vuelaravelcrud/register" class="nav-link">
                <span class="glyphicon glyphicon-user"></span> Sign Up
              </router-link>
            </li>
            <li>
              <router-link to="/vuelaravelcrud/login" class="nav-link">
                <span class="glyphicon glyphicon-log-in"></span> Login
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-active {
  opacity: 0;
}
.panel {
  padding-left: 25px;
}
</style>

<script>
import { HTTP } from "./http-common";
export default {
  created: function() {
    HTTP.interceptors.response.use(undefined, function(err) {
      return new Promise(function(resolve, reject) {
        if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
          this.$store.dispatch(logout);
        }
        throw err;
      });
    });
  },
  computed: {
    isLoggedIn: function() {
      console.log(this.$store.getters.authStatus);
      return this.$store.getters.isLoggedIn;
    },
    userDetail: function() {
      console.log("userdetails");
      if (typeof this.$store.getters.User === "undefined") {
        HTTP.post("details").then(response => {
          console.log(response.data.success.name);
          this.user_name = response.data.success.name;
        });
      } else {
        this.user_name = this.$store.getters.User;
        //return this.$store.getters.User;
      }
    }
  },
  data() {
    return { activeItem: "Home", user_name: "" };
  },
  methods: {
    isActive: function(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive: function(menuItem) {
      this.activeItem = menuItem;
    },
    logout: function() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push({ name: "login" });
      });
    }
  }
};
</script>