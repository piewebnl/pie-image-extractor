<template>
  <template v-for="(item, index) in response.data" :key="index">
    <div v-if="item.status == 'success'" class="notice notice-success">
      <div class="cell thumbnail">
        <img :src="item.resource.thumbnail" />
      </div>
      <div class="cell message">
        <div class="title post-title">{{ item.resource.post.post_title }}</div>
        <div class="title image-title">
          {{ item.resource.image.post_title }}
        </div>
      </div>
    </div>
    <div v-else class="notice notice-error">
      <div class="cell no-thumbnail"></div>
      <div class="cell message">
        <div class="title post-title">{{ item.resource.post.post_title }}</div>
        <div class="title image-title">
          {{ item.resource.image.post_title }}
        </div>
      </div>
    </div>
  </template>
</template>

	
<script>
import { toRef } from "vue";

export default {
  props: {
    jsonResponse: Array,
  },
  setup(props) {
    const response = toRef(props, "jsonResponse");

    return {
      response,
    };
  },
};
</script>
