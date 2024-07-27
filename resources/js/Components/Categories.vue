<template>
  <div>
    <h1>Categories</h1>
    
    <!-- Search Bar -->
    <input v-model="searchQuery" placeholder="Search categories" />
    <button @click="fetchCategories">Search</button>
    <div v-if="error" class="error">{{ error }}</div>

    <!-- Categories List with Pagination -->
    <ul>
      <li v-for="category in paginatedCategories" :key="category.id">
        {{ category.name }}
        <button @click="startEditingCategory(category)">Edit</button>
        <button @click="deleteCategory(category.id)">Delete</button>
      </li>
    </ul>

    <!-- Pagination -->
    <div class="pagination">
      <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1">Previous</button>
      <button 
        v-for="page in pageNumbers" 
        :key="page"
        @click="changePage(page)"
        :class="{ active: page === currentPage }">
        {{ page }}
      </button>
      <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages">Next</button>
    </div>

    <!-- Add Category Modal -->
    <div v-if="showAddCategoryModal" class="modal">
      <div class="modal-content">
        <span @click="closeAddCategoryModal" class="close">&times;</span>
        <h2>Add New Category</h2>
        <input v-model="newCategory.name" placeholder="Category Name" />
        <button @click="createCategory">Add Category</button>
      </div>
    </div>

    <!-- Edit Category Form -->
    <div v-if="editingCategory">
      <h2>Edit Category</h2>
      <input v-model="editingCategory.name" placeholder="Category Name" />
      <button @click="updateCategory">Save Changes</button>
      <button @click="cancelEdit">Cancel</button>
    </div>

    <button @click="openAddCategoryModal">Add New Category</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Categories',
  data() {
    return {
      categories: [], // Initialize as an array
      newCategory: { name: '' },
      searchQuery: '',
      editingCategory: null,
      error: null,
      showAddCategoryModal: false,
      currentPage: 1,
      itemsPerPage: 10,
      totalPages: 0,
    };
  },
  computed: {
    paginatedCategories() {
      return this.categories;
    },
    pageNumbers() {
      const pages = [];
      for (let i = 1; i <= this.totalPages; i++) {
        if (i === 1 || i === this.totalPages || (i >= this.currentPage - 2 && i <= this.currentPage + 2)) {
          pages.push(i);
        } else if (pages[pages.length - 1] !== '...') {
          pages.push('...');
        }
      }
      return pages;
    },
  },
  methods: {
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categories', {
          params: {
            search: this.searchQuery,
            page: this.currentPage,
            per_page: this.itemsPerPage // Ensure this is included if your API supports it
          },
        });
        this.categories = response.data.data; // Update with the actual data structure
        this.totalPages = response.data.last_page; // Update with the actual data structure
      } catch (error) {
        this.error = 'Failed to fetch categories';
      }
    },
    async createCategory() {
      try {
        const response = await axios.post('/api/categories', this.newCategory);
        this.categories.push(response.data);
        this.newCategory.name = '';
        this.closeAddCategoryModal(); // Close modal after adding
        this.fetchCategories(); // Refresh categories
      } catch (error) {
        this.error = 'Failed to create category';
      }
    },
    startEditingCategory(category) {
      this.editingCategory = { ...category }; // Create a copy for editing
    },
    async updateCategory() {
      try {
        const response = await axios.put(`/api/categories/${this.editingCategory.id}`, this.editingCategory);
        const index = this.categories.findIndex(cat => cat.id === this.editingCategory.id);
        this.categories.splice(index, 1, response.data); // Update the category in the list
        this.cancelEdit(); // Reset the edit form
      } catch (error) {
        this.error = 'Failed to update category';
      }
    },
    async deleteCategory(id) {
      try {
        await axios.delete(`/api/categories/${id}`);
        this.categories = this.categories.filter(category => category.id !== id);
      } catch (error) {
        this.error = 'Failed to delete category';
      }
    },
    openAddCategoryModal() {
      this.showAddCategoryModal = true;
    },
    closeAddCategoryModal() {
      this.showAddCategoryModal = false;
    },
    cancelEdit() {
      this.editingCategory = null; // Clear the edit form
    },
    changePage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
        this.fetchCategories(); // Fetch categories for the new page
      }
    },
  },
  created() {
    this.fetchCategories();
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
.error {
  color: red;
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
  width: 400px;
}
.close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  cursor: pointer;
}
.pagination {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}
.pagination button.active {
  font-weight: bold;
  background-color: #42b983;
  color: white;
}
</style>
