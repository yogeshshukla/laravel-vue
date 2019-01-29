<template>
  <div class="panel">
    <h1>Register a User</h1>
    <form @submit.prevent="Register">
      <ul>
        <li v-for="val_error in val_errors" style="color:red">
          {{ val_error }}
        </li>
      </ul>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" v-model="user.name">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Email:</label>
            <input type="text"  class="form-control" v-model="user.email">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Password:</label>
            <input type="password"  class="form-control" v-model="user.password">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Confirm Password:</label>
            <input type="c_password" class="form-control" v-model="user.c_password">
          </div>
        </div>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</template>

<script>
import { HTTP } from "../http-common";
export default {
  data() {
    return {
      user: {},
      val_errors : {}
    };
  },
  methods: {
    Register() {
      this.$store.dispatch('register', this.user)
       .then( () => this.$router.push({ name: "posts" }) )
       .catch(err => 
         this.val_errors = err.response.data.error
          //console.log()
       )

      // HTTP.post("/register", this.user).then(response => {
      //   this.$router.push({ name: "posts" });
      // });
    }
  }
};
</script>