import { ref, onMounted } from 'vue';
import axios from 'axios';

export function usePets() {
    const pets = ref([]);
    const pet = ref({ name: '', status: '' });

    const fetchPets = async () => {
        try {
            const response = await axios.get('/api/pets');
            pets.value = response.data;
        } catch (error) {
            console.error('Failed to fetch pets:', error);
        }
    };

    const addPet = async () => {
        try {
            const response = await axios.post('/api/pets', pet.value);
            pets.value.push(response.data);
            pet.value.name = '';
            pet.value.status = '';
        } catch (error) {
            console.error('Failed to add pet:', error);
        }
    };

    const editPet = (selectedPet) => {
        pet.value = { ...selectedPet };
    };

    const updatePet = async (id) => {
        try {
            const response = await axios.put(`/api/pets/${id}`, pet.value);
            const index = pets.value.findIndex(p => p.id === id);
            pets.value[index] = response.data;
            pet.value.name = '';
            pet.value.status = '';
        } catch (error) {
            console.error('Failed to update pet:', error);
        }
    };

    const deletePet = async (id) => {
        try {
            await axios.delete(`/api/pets/${id}`);
            pets.value = pets.value.filter(pet => pet.id !== id);
        } catch (error) {
            console.error('Failed to delete pet:', error);
        }
    };

    onMounted(fetchPets);

    return {
        pets,
        pet,
        fetchPets,
        addPet,
        editPet,
        updatePet,
        deletePet
    };
}
