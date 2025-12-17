<script setup>
import { ref, onMounted } from "vue";
import api from "../axios.js";
import PetForm from "../components/PetForm.vue";
import ConfirmDialog from "../components/ConfirmDialog.vue";

const pets = ref([]);
const selectedPet = ref(null);
const petToDelete = ref(null);
const showConfirm = ref(false);
const error = ref("");

const loadPets = async () => {
  try {
    pets.value = (await api.get("/pets")).data;
  } catch {
    error.value = "Failed to load pets.";
  }
};

const onSaved = () => {
  selectedPet.value = null;
  loadPets();
};

const editPet = (pet) => {
  selectedPet.value = pet;
};

const askDelete = (pet) => {
  petToDelete.value = pet;
  showConfirm.value = true;
};

const confirmDelete = async () => {
  try {
    await api.delete(`/pets/${petToDelete.value.id}`);
    pets.value = pets.value.filter(p => p.id !== petToDelete.value.id);
  } catch {
    alert("Failed to delete pet.");
  } finally {
    showConfirm.value = false;
    petToDelete.value = null;
  }
};

const cancelDelete = () => {
  showConfirm.value = false;
  petToDelete.value = null;
};

onMounted(loadPets);
</script>

<template>

  <PetForm
    :pet="selectedPet"
    @saved="onSaved"
    @cancel="selectedPet = null"
  />

  <p v-if="error" class="error">{{ error }}</p>

  <table v-if="pets.length" class="pets-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Breed</th>
        <th>Size</th>
        <th>Birthdate</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="pet in pets" :key="pet.id">
        <td>{{ pet.name }}</td>
        <td>{{ pet.breed }}</td>
        <td class="capitalize">{{ pet.size }}</td>
        <td>{{ pet.birthdate }}</td>
        <td class="actions">
          <button class="btn edit" @click="editPet(pet)">Edit</button>
          <button class="btn delete" @click="askDelete(pet)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>

  <p v-else>No pets found.</p>

  <ConfirmDialog
    :show="showConfirm"
    title="Delete pet"
    :message="`Are you sure you want to delete ${petToDelete?.name}?`"
    @confirm="confirmDelete"
    @cancel="cancelDelete"
  />
</template>
<style scoped>
  .pets-table {
  width: 100%;
  border-collapse: collapse;
  background: var(--card);
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
}

.pets-table th {
  background-color: #eef2ff;
  color: var(--primary-dark);
  text-transform: uppercase;
  font-size: 0.75rem;
  letter-spacing: 0.06em;
}

.pets-table td,
.pets-table th {
  padding: 1rem;
  text-align: center;
  border-bottom: 1px solid #e5e7eb;
}

.pets-table tr:hover {
  background-color: #f9fafb;
}

.pets-table td:first-child {
  font-weight: 600;
}

.actions {
  display: flex;
  justify-content: center;
  gap: 0.6rem;
}

.btn {
  padding: 0.45rem 0.9rem;
  border-radius: 999px;
  font-size: 0.8rem;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn.edit {
  background-color: var(--primary);
  color: white;
}

.btn.edit:hover {
  background-color: var(--primary-dark);
}

.btn.delete {
  background-color: var(--danger);
  color: white;
}

.btn.delete:hover {
  opacity: 0.9;
}

.capitalize {
  text-transform: capitalize;
}

.error {
  color: #b91c1c;
  margin-top: 1rem;
}

</style>