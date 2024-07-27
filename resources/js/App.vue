<template>
    <div>
      <NavBar />
      <router-view></router-view>
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
  /* Global styles go here */
  </style>