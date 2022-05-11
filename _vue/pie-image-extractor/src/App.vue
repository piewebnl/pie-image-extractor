<template>
  <div class="pie-image-extractor">
    <p>Total posts found with images: {{ totalPosts }}</p>
    <p class="submit">
      <button
        id="pie-image-extractor-submit"
        class="button button-primary"
        @click="extractPerPage()"
        v-if="doneLoading"
      >
        Extract images from posts and copy
      </button>
    </p>
    <div v-if="extractingStatus == 'done'" class="notice notice-success">Images extracted and copied!<br />
    Images are stored in: /wp-content/uploads/pie-image-extractor/</div>
    <p v-if="extractingStatus == 'busy'">Total pages: {{ page }} / {{ totalPages }}</p>
    <template v-for="(jsonResponse, index) in jsonResponses" :key="index">
      <ResponseTable :jsonResponse="jsonResponse"></ResponseTable>
    </template>
  </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import ResponseTable from "@/components/ResponseTable";
import { useConfigStore } from "@/use/ConfigStore";
import { UsePaginate } from "@/use/Paginate";

export default {
  components: {
    ResponseTable,
  },

  setup() {
    const { baseUrl } = useConfigStore();
    const { paginateArray } = UsePaginate();

    const doneLoading = ref(false);
    const extractingStatus = ref(""); // status: "", "busy", "done"
    const postsWithImages = ref([]); // post ids
    const page = ref(1);
    const perPage = ref(10);
    const totalPosts = ref(0);
    const idsToProcess = ref([]);
    const jsonResponses = ref([]); // array of responses (success, errors, resource data)

    const totalPages = computed(() => {
      return Math.ceil(totalPosts.value / perPage.value);
    });

    async function extractPerPage() {
      extractingStatus.value = "busy";
      for (let i = 1; i <= totalPages.value; i++) {
        page.value = i;
        idsToProcess.value = paginateArray(
          postsWithImages.value,
          i,
          perPage.value
        );
        await extractImages();
      }
      extractingStatus.value = "done";
    }

    async function extractImages() {
      await axios
        .post(baseUrl.value + "/wp-json/image-extractor/v1/extract-images", {
          ids: idsToProcess.value,
        })
        .then((response) => {
          jsonResponses.value.push(response);
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    }

    async function getPostsWithImages() {
      await axios
        .get(baseUrl.value + "/wp-json/image-extractor/v1/posts-with-images")
        .then((response) => {
          postsWithImages.value = response.data;
          totalPosts.value = postsWithImages.value.length;
          doneLoading.value = true;
        })
        .catch((error) => {
          console.log(error);
        });
    }

    onMounted(() => {
      getPostsWithImages();
    });

    return {
      baseUrl,
      doneLoading,
      extractingStatus,
      paginateArray,
      page,
      perPage,
      totalPosts,
      totalPages,
      postsWithImages,
      extractPerPage,
      extractImages,
      jsonResponses,
    };
  },
};
</script>


<style>

.pie-image-extractor .notice .thumbnail img {
  width: 50px;
  height: 50px;
}


.pie-image-extractor .notice .thumbnail {
  padding: 0;
}

.pie-image-extractor .notice {
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}
.pie-image-extractor .notice .message {
  padding: 0.5rem;
}

</style>