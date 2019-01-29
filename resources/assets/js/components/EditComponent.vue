<template>
  <div class="panel">
    <h1>Edit Post</h1>
    <form @submit.prevent="updatePost">
      <ul>
        <li v-for="val_error in val_errors" style="color:red">{{ val_error }}</li>
      </ul>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Post Title:</label>
            <input type="text" class="form-control" v-model="post.title">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Post Body:</label>
            <textarea class="form-control" v-model="post.body" rows="5"></textarea>
          </div>
        </div>
      </div>
      <br>
      <div class="form-group">
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</template>

<script>
//import { HTTP } from "../http-common";
import axios from 'axios'
export default {
  data() {
    return {
      post: {},
      val_errors: {}
    };
  },
  created() {
    let uri = `post/edit/${this.$route.params.id}`;
    axios.get(uri).then(response => {
      this.post = response.data;
    });
  },
  methods: {
    updatePost() {
      let uri = `post/update/${this.$route.params.id}`;
      axios.post(uri, this.post)
        .then(response => {
          this.$router.push({ name: "posts" });
        })
        .catch(
          err => (this.val_errors = err.response.data.error)
          //console.log()
        );
    }
  }
};
</script>