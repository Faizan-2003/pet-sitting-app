<script setup>
const props = defineProps({
  show: Boolean,
  title: {
    type: String,
    default: "Confirm action",
  },
  message: {
    type: String,
    required: true,
  },
});

const emit = defineEmits(["confirm", "cancel"]);
</script>

<template>
  <div v-if="show" class="overlay">
    <div class="modal">
      <h3>{{ title }}</h3>
      <p>{{ message }}</p>

      <div class="actions">
        <button class="btn secondary" @click="emit('cancel')">
          Cancel
        </button>
        <button class="btn danger" @click="emit('confirm')">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
}

.modal h3 {
  margin-top: 0;
}

.actions {
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  margin-top: 1.5rem;
}

.btn {
  padding: 0.5rem 1rem;
  border-radius: 4px;
  border: none;
  cursor: pointer;
}

.btn.secondary {
  background: #aaa;
  color: white;
}

.btn.danger {
  background: #d32f2f;
  color: white;
}
</style>
