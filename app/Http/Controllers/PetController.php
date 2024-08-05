<?php

namespace App\Http\Controllers;

use Exception;
use App\Service\PetService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    public function __construct(protected PetService $petService)
    {
    }

    public function index(): JsonResponse
    {
        $pets = $this->petService->getAllPets();
        return response()->json($pets);
    }

    public function store(StorePetRequest $request): JsonResponse
    {
        try {
            $pet = $this->petService->createPet($request->validated());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json($pet, 201);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $pet = $this->petService->getPetById($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json($pet);
    }

    public function update(UpdatePetRequest $request, int $id): JsonResponse
    {
        try {
            $pet = $this->petService->updatePet($id, $request->validated());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json($pet);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->petService->deletePet($id);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return response()->json(null, 204);
    }
}
