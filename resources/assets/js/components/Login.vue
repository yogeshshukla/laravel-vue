<template>
  <div class="panel">
    <h1>User Login</h1>
    <form @submit.prevent="Login">
      <span style="color:red" v-if="auth_error">Please enter valid Email and Password</span>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" v-model="user.email">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" v-model="user.password">
          </div>
        </div>
      </div>
      <br>
      <div class="form-group">
        <button class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
//import { HTTP } from "../http-common";
export default {
  data() {
    return {
      user: {},
      auth_error : false
    };
  },
  methods: {
    Login() {
      this.$store.dispatch('login', this.user)
       .then( () => 
          this.$router.push({ name: "posts" }) 
       )
       .catch(err => 
          this.auth_error = true
          //console.log(err.response.data.error)
       )

      // HTTP.post("/login", this.user).then(response => {
      //   this.$router.push({ name: "posts" });
      // });
    }
  }
};
</script>