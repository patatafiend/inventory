import { createApp } from 'vue';
import CategoryTree from './components/CategoryTree.vue';

const app = createApp({});
app.component('category-tree', CategoryTree);
app.mount('#app');