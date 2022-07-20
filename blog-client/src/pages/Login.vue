<template>
  <div>
    <form v-on:submit.prevent="login">
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { useStore } from 'vuex'

export default {
  setup() {
    const store = useStore()

    const login = () => {
      store.dispatch('login', {
        email: 'haleemhosein@yahoo.com',
        password: 'password'
      })
    }

    return {
      login
    }
  }
}
</script>

