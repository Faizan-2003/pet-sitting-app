<script setup>
import { ref, watch, computed } from "vue";
import api from "../axios.js";

const props = defineProps({
  pet: {
    type: Object,
    default: null,
  },
});

const emit = defineEmits(["saved", "cancel"]);

const isEditMode = computed(() => !!props.pet?.id);

const form = ref({
  name: "",
  breed: "",
  size: "small",
  birthdate: "",
});

const error = ref("");

const reset = () => {
  form.value = {
    name: "",
    breed: "",
    size: "small",
    birthdate: "",
  };
};

const cancelEdit = () => {
  reset();
  emit("cancel");
};

watch(
  () => props.pet,
  (pet) => {
    if (pet) {
      form.value = {
        name: pet.name,
        breed: pet.breed,
        size: pet.size,
        birthdate: pet.birthdate,
      };
    } else {
      reset();
    }
  },
  { immediate: true }
);

const submit = async () => {
  error.value = "";

  if (!form.value.name || !form.value.breed || !form.value.birthdate) {
    error.value = "All fields are required.";
    return;
  }

  try {
    if (isEditMode.value) {
      await api.put(`/pets/${props.pet.id}`, form.value);
    } else {
      await api.post("/pets", form.value);
    }

    emit("saved");
    reset();
  } catch (err) {
    error.value =
      err.response?.data?.error || "An unexpected error occurred.";
  }
};
</script>

<template>
  <div class="form-card">
    <h2>{{ isEditMode ? "Edit Pet" : "Add New Pet" }}</h2>

    <p v-if="error" class="error">{{ error }}</p>

    <form @submit.prevent="submit">
      <div class="form-group">
        <label>Name</label>
        <input v-model="form.name" placeholder="Pet name" />
      </div>

      <div class="form-group">
        <label>Breed</label>
        <input v-model="form.breed" placeholder="Breed" />
      </div>

      <div class="form-group">
        <label>Size</label>
        <select v-model="form.size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>

      <div class="form-group">
        <label>Birthdate</label>
        <input type="date" v-model="form.birthdate" />
      </div>

      <div class="actions">
        <button type="submit" class="btn primary">
          {{ isEditMode ? "Update Pet" : "Create Pet" }}
        </button>

        <button
          v-if="isEditMode"
          type="button"
          class="btn secondary"
          @click="cancelEdit"
        >
          Cancel
        </button>
      </div>
    </form>
  </div>
</template>
<style scoped>
.form-card {
  background: var(--card);
  border-radius: 14px;
  padding: 2.2rem;
  margin-bottom: 2.5rem;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
}

.form-card h2 {
  margin-top: 0;
  margin-bottom: 1.8rem;
  font-size: 1.4rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.3rem;
}

label {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--muted);
  margin-bottom: 0.4rem;
}

input,
select {
  padding: 0.7rem 0.8rem;
  border-radius: 8px;
  border: 1px solid #d1d5db;
  font-size: 0.9rem;
}

input:focus,
select:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
}

.actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.btn.primary {
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  color: white;
  font-weight: 600;
  padding: 0.7rem 1.8rem;
  border-radius: 999px;
  letter-spacing: 0.02em;
  box-shadow: 0 10px 25px rgba(79, 70, 229, 0.35);
  transition: all 0.2s ease;
}

.btn.primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 14px 32px rgba(79, 70, 229, 0.45);
}

.btn.secondary {
  background: linear-gradient(135deg, #9ca3af, #6b7280);
  color: white;
  font-weight: 600;
  padding: 0.7rem 1.8rem;
  border-radius: 999px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.error {
  background-color: #fee2e2;
  color: #991b1b;
  padding: 0.75rem;
  border-radius: 8px;
  margin-bottom: 1rem;
}
</style>