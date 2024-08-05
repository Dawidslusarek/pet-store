<?php

namespace App\Service;

use App\DTO\PetDTO;
use App\Repository\PetRepository;


class PetService
{
    public function __construct(protected PetRepository $petRepository)
    {
    }

    public function getAllPets(): array
    {
        return $this->petRepository->getAll();
    }

    public function getPetById(int $id): PetDTO
    {
        $pet = $this->petRepository->findById($id);
        return new PetDTO($pet);
    }

    public function createPet(array $data): PetDTO
    {
        $pet = $this->petRepository->create($data);
        return new PetDTO($pet);
    }

    public function updatePet(int $id, array $data): PetDTO
    {
        $pet = $this->petRepository->update($id, $data);
        return new PetDTO($pet);
    }

    public function deletePet(int $id): void
    {
        $this->petRepository->delete($id);
    }
}
