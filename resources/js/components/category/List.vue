<template>
  <div class="row">
    <div class="col-4"></div>
    <div
      class="col-4 mb-2 flex-column align-items-center justify-content-center"
    >
      <button @click="getMedia(1)" class="btn btn-primary w-100 mb-4">
        <span v-if="loading != 1">Button 1: Sync Matrix</span>
        <span v-if="loading == 1">Loading...</span>
      </button>
      <button @click="getMedia(2)" class="btn btn-primary w-100 mb-4">
        <span v-if="loading != 2">Button 2: Sync Matrix Reloaded</span>
        <span v-if="loading == 2">Loading...</span>
      </button>
      <button @click="getMedia(3)" class="btn btn-primary w-100 mb-4">
        <span v-if="loading != 3">Button 3: Sync Matrix Revolutions</span>
        <span v-if="loading == 3">Loading...</span>
      </button>
      <button @click="truncateMedia()" class="btn btn-danger mb-4">
        Reset (Truncate) Database
      </button>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>All Media ({{ medias.length }} records)</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Year</th>
                  <th>IMDB ID</th>
                  <th>Type</th>
                  <th>Poster</th>
                </tr>
              </thead>
              <tbody v-if="medias.length > 0">
                <tr v-for="(media, key) in medias" :key="key">
                  <td>{{ media.id }}</td>
                  <td>{{ media.title }}</td>
                  <td>{{ media.year }}</td>
                  <td>{{ media.imdb_id }}</td>
                  <td>{{ media.type }}</td>
                  <td>
                    <span v-if="media.poster != null">
                      <img :src="media.poster.poster_url" width="80" />
                    </span>
                    <span v-if="media.poster == null"> N/A </span>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="6" align="center">No medias Found.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "medias",
  data() {
    return {
      medias: [],
      loading: 0,
    };
  },
  mounted() {
    this.getMedias();
  },
  methods: {
    async getMedia(id) {
      this.loading = id;
      await this.axios
        .get("/api/get/" + id)
        .then((response) => {
          // this.medias = response.data;
          console.log(response);
          console.log(response.data);
          if (response.data === 1) {
            this.getMedias();
          }
        })
        .catch((error) => {
          console.log(error);
        })
        .then(() => {
          this.loading = 0;
        });
    },
    async getMedias() {
      await this.axios
        .get("/api/media")
        .then((response) => {
          this.medias = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.medias = [];
        });
    },
    truncateMedia(id) {
      if (
        confirm("Are you sure you want to truncate media and poster tables?")
      ) {
        this.axios
          .delete(`/api/truncate`)
          .then((response) => {
            this.getMedias();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>