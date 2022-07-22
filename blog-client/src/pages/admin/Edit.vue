<template>
  <div>
    <ResizeTextarea v-if="post.title">
      <template v-slot:default="{resize, el}">
        <textarea v-model="post.title" v-on:input="resize" :ref="el"
                  class="w-full text-center 4xl sm:text-6xl leading-10 font-extrabold tracking-tight text-gray-900 border-none focus:ring-0 resize-none p-0"></textarea>
      </template>
    </ResizeTextarea>
  </div>
</template>

<script>
import useAdminPosts from "../../api/useAdminPosts.js";
import {onMounted, watch} from "vue";
import _ from "lodash"
import ResizeTextarea from "../../components/ResizeTextarea.vue";

export default {
  components: {ResizeTextarea},
  props: {
    slug: {
      required: true,
      type: String,
    }
  },
  setup(props) {
    const {post, fetchPost, patchPost} = useAdminPosts()

    const updatePost = async () => {
      await patchPost(props.slug)
    }

    onMounted(async () => {
      await fetchPost(props.slug)

      watch(() => _.cloneDeep(post), _.debounce(() => {
        updatePost()
      }, 500))
    })

    return {
      post
    }
  },
}
</script>

