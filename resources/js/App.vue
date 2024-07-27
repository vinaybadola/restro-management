<template>
    <div>
      <NavBar />
      <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
    </div>
  </template>
  
  <script>
import NavBar from './Components/NavBar.vue';
  
  export default {
    components: {
        NavBar,
    },
  };
  </script>
  
  <style>
  * {
    font-family: scandia-web,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji";
  }
  </style>