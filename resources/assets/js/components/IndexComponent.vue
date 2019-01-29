<template>
  <div class="container panel">
    <h1>Posts</h1>
    <div class="row">
      <div class="col-md-10"></div>
      <div class="col-md-2">
        <router-link :to="{ name: 'create' }" class="btn btn-primary">Create Post</router-link>
      </div>
    </div>
    <br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Item Name</th>
          <th>Item Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.body }}</td>
          <td>
            <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit</router-link>
          </td>
          <td>
            <button class="btn btn-danger" @click.prevent="deletePost(post.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
//import { HTTP } from "../http-common";
import axios from "axios";
export default {
  data() {
    return {
      posts: []
    };
  },
  created() {
    axios.get("posts").then(response => {
      this.posts = response.data.data;
    });
  },
  methods: {
    deletePost(id) {
      let uri = `post/delete/${id}`;
      axios.delete(uri).then(response => {
        this.posts.splice(this.posts.indexOf(id), 1);
      });
    }
  }
};
</script>