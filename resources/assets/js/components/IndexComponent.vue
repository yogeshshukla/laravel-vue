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

    <!-- <table class="table table-hover">
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
    </table>-->
    <!-- <v-client-table 
          :data="tableData"
          :columns="columns" 
          :options="options">
    </v-client-table>-->
    <v-server-table url="/posts" :columns="columns" :options="options" ref="postTable">
      <template slot="action" slot-scope="props">
        <router-link :to="{name: 'edit', params: { id: props.row.id }}" class="btn btn-primary">Edit</router-link>
        <button class="btn btn-danger" @click.prevent="deletePost(props.row.id)">Delete</button>
      </template>
    </v-server-table>
  </div>
</template>

<script>
//import { HTTP } from "../http-common";
import axios from "axios";
export default {
  data() {
    return {
      // posts: []
      columns: ["id", "title", "body", "action"],
      tableData: [],
      options: {
        headings: {
          id: "ID",
          title: "Title",
          body: "Bodyy",
          action: "Actions"
        },
        sortable: ["title", "body", "id"],
        filterable: ["title", "body"],
        columnsClasses : {
          body : 'set-width-column-body',
          action : 'set-width-column-action'
        }
      }
    };
  },
  created() {
    // axios.get("posts").then(response => {
    //   this.tableData = response.data.data;
    // });
  },
  methods: {
    deletePost(id) {
      let uri = `post/delete/${id}`;
      axios.delete(uri).then(response => {
        this.$refs.postTable.refresh();
      });
    }
  }
};
</script>
