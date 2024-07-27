<template>
  <div>
    <h1>Welcome to The Restaurant!</h1>
    <ul>
      <li v-for="restaurant in restaurants" :key="restaurant.id">
        {{ restaurant.name }}
        <span>({{ restaurant.categories.length }} categories)</span>
        <button @click="toggleCategories(restaurant.id)">
          {{ restaurant.showCategories ? 'Hide Categories' : 'Show Categories' }}
        </button>
        <button @click="showCategoryModal(restaurant.id)">Add Category</button>

        <!-- Show categories of the restaurant -->
        <div v-if="restaurant.showCategories">
          <h3>Categories:</h3>
          <ul>
            <li v-for="category in restaurant.categories" :key="category.id">
              {{ category.name }}
              <button @click="removeCategoryFromRestaurant(restaurant.id, category.id)">Delete</button>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <!-- Modal for adding categories -->
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <h2>Add Category to Restaurant</h2>
        <select v-model="selectedCategory">
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <button @click="addCategoryToRestaurant">Add Category</button>
        <button @click="hideCategoryModal">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Restaurants',
  data() {
    return {
      restaurants: [],
      categories: [],
      selectedCategory: null,
      showModal: false,
      currentRestaurantId: null,
    };
  },
  created() {
    this.fetchRestaurants();
    this.fetchCategories(); // Fetch categories on creation
  },
  methods: {
    async fetchRestaurants() {
      try {
        const response = await axios.get('/api/restaurants');
        console.log('resp', response)
        this.restaurants = response.data.map(restaurant => ({
          ...restaurant,
          showCategories: false, // Initialize showCategories property
        }));
      } catch (error) {
        console.error('Error fetching restaurants:', error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('/api/showAllCategories'); // Ensure this endpoint exists
        this.categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    showCategoryModal(restaurantId) {
      this.currentRestaurantId = restaurantId;
      this.showModal = true;
    },
    hideCategoryModal() {
      this.showModal = false;
      this.selectedCategory = null;
    },
    async addCategoryToRestaurant() {
      try {
        await axios.post(`/api/restaurants/${this.currentRestaurantId}/categories`, {
          category_id: this.selectedCategory,
        });
        this.hideCategoryModal();
        this.fetchRestaurants(); // Refresh the list
      } catch (error) {
        console.error('Error adding category to restaurant:', error);
      }
    },
    toggleCategories(restaurantId) {
      const restaurant = this.restaurants.find(r => r.id === restaurantId);
      if (restaurant) {
        restaurant.showCategories = !restaurant.showCategories;
        // Optionally fetch categories if needed
      }
    },
    async removeCategoryFromRestaurant(restaurantId, categoryId) {
    try {
      alert('Are you sure you want to delete this category?');
      await axios.delete(`/api/restaurants/${restaurantId}/categories/${categoryId}`);
      this.fetchRestaurants(); // Refresh the list
    } catch (error) {
      console.error('Error removing category from restaurant:', error);
    }
  },
  },
};
</script>

<style scoped>
h1 {
  color: #42b983;
  text-align: center;
}
button {
  margin-left: 10px;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-content {
  background: white;
  padding: 20px;
  border-radius: 5px;
  width: 300px;
}
</style>


