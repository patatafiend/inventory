<template>
  <ul>
    <li v-for="category in categories" :key="category.id">
      {{ category.name }}
      <button @click="toggle(category.id)">[+]</button>
      <ul v-if="category.showChildren">
        <li v-for="child in category.children" :key="child.id">
          {{ child.name }}
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
export default {
  props: ['categories'],
  data() {
    return {
      expandedCategories: {}
    };
  },
  methods: {
    toggle(id) {
      this.expandedCategories[id] = !this.expandedCategories[id];
    }
  }
};
</script>
