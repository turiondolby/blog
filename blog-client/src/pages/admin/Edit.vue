<template>
  <div>
    <div class="absolute w-full left-0 top-0 p-6 flex justify-between items-center space-x-6">
      <div class="flex-grow flex item-center">
        <span class="mr-1">/</span>
        <input v-model="post.slug" v-on:click="$event.target.select()"
               type="text" class="p-0 border-none focus:ring-0 w-full" spellcheck="false"
        >
      </div>

      <div class="flex items-baseline space-x-6">
        <div>
          <span class="text-sm text-gray-500">Autosaved</span>
        </div>
        <button
            v-on:click="post.published_at ? post.published_at = null : post.published_at = (new Date()).toISOString()"
            v-bind:class="{'text-pink-500': post.published_at}"
            class="text-sm font-medium">
          {{ !post.published_at ? 'Publish' : 'Unpublish' }}
        </button>
        <router-link v-if="post.title" :to="{ name: 'post', params: { slug: post.slug } }" class="text-sm font-medium text-gray-800">
          Preview
        </router-link>
      </div>
    </div>
    <div>
      <ResizeTextarea>
        <template v-slot:default="{resize, el}">
        <textarea v-model="post.title" v-on:input="resize" :ref="el"
                  class="w-full text-center 4xl sm:text-6xl leading-10 font-extrabold tracking-tight text-gray-900 border-none focus:ring-0 resize-none p-0"></textarea>
        </template>
      </ResizeTextarea>
    </div>

    <Editor v-model="post.body"/>

  </div>
</template>

<script>
import useAdminPosts from "../../api/useAdminPosts.js";
import {onMounted, watch, watchEffect} from "vue";
import _ from "lodash"
import ResizeTextarea from "../../components/ResizeTextarea.vue";
import Editor from "../../components/Editor.vue";
import slugify from "slugify";

export default {
  components: {ResizeTextarea, Editor},
  props: {
    uuid: {
      required: true,
      type: String,
    }
  },
  setup(props) {
    const {post, fetchPost, patchPost} = useAdminPosts()

    const updatePost = async () => {
      await patchPost(props.uuid)
    }

    onMounted(async () => {
      await fetchPost(props.uuid)

      const replaceSlug = () => {
        const slug = post.value.slug

        if (slug.charAt(slug.length - 1) === ' ') {
          return
        }

        post.value.slug = slug
            ? slugify(slug, {strict: true})
            : post.value.uuid
      }

      watchEffect(() => {
        replaceSlug()
      })

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

