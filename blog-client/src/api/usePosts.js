import { ref } from "vue"
import axios from "axios";

export default function usePosts() {
    const posts = ref([])

    const fetchPosts = async () => {
        let response = await axios.get('api/posts')
        posts.value = response.data.data
    }

    return {
        posts,
        fetchPosts
    }
}
