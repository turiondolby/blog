import { ref } from "vue"
import axios from "axios";

export default function useAdminPosts() {
    const posts = ref([])

    const fetchPosts = async () => {
        let response = await axios.get('api/admin/posts')
        posts.value = response.data.data
    }

    return {
        posts,
        fetchPosts,
    }
}
