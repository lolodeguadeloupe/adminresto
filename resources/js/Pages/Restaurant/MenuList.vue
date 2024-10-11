<template>
    <div>
      <h1>Menu List</h1>
      <div v-for="category in menuList" :key="category.name">
        <h2>{{ category.name }}</h2>
        <ul>
          <li v-for="item in category.items" :key="item.name">
            {{ item.name }} - {{ item.price }}
            <span v-if="item.available">Available</span>
            <span v-else>Not Available</span>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      menuList: Array,
    },
  }
  </script>