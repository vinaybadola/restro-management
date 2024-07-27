<!-- resources/js/components/Navbar.vue -->
<template>
    <nav>
      <ul>
        <li><router-link to="/">Restaurants</router-link></li>
        <li><router-link to="/categories">Categories</router-link></li>
      </ul>
    </nav>
  </template>
  
  <script>
  export default {
    name: 'NavBar',
  };
  </script>
  
  <style scoped>
  nav {
    background-color: #333;
    padding: 10px;
  }
  ul {
    list-style-type: none;
    display: flex;
    justify-content: space-around;
  }
  li {
    color: white;
  }
  a {
    color: white;
    text-decoration: none;
  }
  </style>
  