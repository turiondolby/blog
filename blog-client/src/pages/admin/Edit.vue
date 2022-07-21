<template>
  <div>
    {{post}}
  </div>
</template>

<script>
import useAdminPosts from "../../api/useAdminPosts.js";
import {onMounted} from "vue";

export default {
  props: {
    slug: {
      required: true,
      type: String,
    }
  },
  setup(props) {
    const {post, fetchPost} = useAdminPosts()

    onMounted(fetchPost(props.slug))

    return {
      post
    }
  },
}
</script>

