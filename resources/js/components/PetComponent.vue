<template>
  <div>
    <form @submit.prevent="addPet" class="max-w-sm mx-auto p-10 flex flex-col gap-y-4">
      <input
        v-model="pet.name"
        placeholder="Name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        required
      />
      <select
        v-model="pet.status"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      >
        <option disabled value="">Please select one</option>
        <option value="pending">Pending</option>
        <option value="available">Available</option>
        <option value="sold">Sold</option>
      </select>
      <button
        class="block mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="submit"
      >
        Add Pet
      </button>
    </form>

    <ul class="grid grid-cols-3 py-20 mx-auto justify-center items-center">
      <li v-for="pet in pets" :key="pet.id" class="text-center">
        {{ pet.id }}.{{ pet.name }} - {{ pet.status }}
        <button class="mr-4 text-gray-800 font-semibold" @click="editPet(pet)">
          Edit
        </button>
        <button class="text-red-800 font-semibold" @click="deletePet(pet.id)">
          Delete
        </button>
      </li>
    </ul>

    <div v-if="pet.id">
      <h3>Edit Pet</h3>
      <form @submit.prevent="updatePet(pet.id)">
        <input v-model="pet.name" placeholder="Name" required />
        <input v-model="pet.status" placeholder="Status" required />
        <button type="submit">Update Pet</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { usePets } from "../composables/usePets";

const { pets, pet, addPet, editPet, updatePet, deletePet } = usePets();
</script>
