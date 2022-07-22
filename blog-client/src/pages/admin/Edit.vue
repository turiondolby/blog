<template>
  <div>
    <textarea v-model="post.title"
              class="w-full text-center 4xl sm:text-6xl leading-10 font-extrabold tracking-tight text-gray-900 border-none focus:ring-0 resize-none p-0"></textarea>
  </div>
</template>

<script>
import useAdminPosts from "../../api/useAdminPosts.js";
import {onMounted, watch} from "vue";
import _ from "lodash"

export default {
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

