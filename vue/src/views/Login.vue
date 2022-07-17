
<template>

    <div>
        <img class="mx-auto h-20 w-auto" src="/src/assets/soccerball.svg" alt="Soccer_ball_svg" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Log in to your account</h2>
         <p class="mt-2 text-center text-sm text-gray-600">
          or
          <router-link :to="{name: 'Register'}" class="font-medium text-indigo-600 hover:text-indigo-500"><br  />Register a new user </router-link>
        </p>
       
      </div>
      <form class="mt-8 space-y-6"  @submit="login">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" v-model="user.email" autocomplete="email" required="" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="E-mail address" />
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" v-model="user.password" autocomplete="current-password" required="" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
          </div>
        </div>
          <div v-if="errorMsg" class="group relative flex justify-center w-full px-3 py-2 bg-red-500 text-white text-center text-sm font-medium rounded-md">
            <span @click="errorMsg = ''" class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-300 hover:text-gray-100 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></span>
            {{ errorMsg }}
          </div>

        <div>
          <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            Sign in
          </button>
        </div>
      </form>
   
</template>

<script setup>
import { LockClosedIcon } from '@heroicons/vue/solid'
import store from '../store';
import { useRouter } from 'vue-router';
import { ref } from 'vue';

const router = useRouter();
const user = {
  email: '',
  password: '',
  remember: false,
}
let errorMsg = ref('');

function login(ev) {
  ev.preventDefault();

  store.dispatch('login', user)
    .then((res) => {
      router.push({
        name: 'Dashboard'
      })
    })
  .catch(err => {
    errorMsg.value = err.response.data.error
  })
}
</script>