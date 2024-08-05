<?php

namespace App\Repository;

use Exception;
use GuzzleHttp\Client;

class PetRepository
{
    public function __construct(
        protected Client $client,
        protected string $baseUrl = 'https://petstore.swagger.io/v2'
    ) {
    }

    public function getAll(): array
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/pet/findByStatus?status=available");
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function findById(int $id): array
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/pet/{$id}");
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function create(array $data): array
    {
        try {
            $response = $this->client->post("{$this->baseUrl}/pet", [
                'json' => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function update(int $id, array $data): array
    {
        $data['id'] = $id;

        try {
            $response = $this->client->put("{$this->baseUrl}/pet", [
                'json' => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    public function delete(int $id): void
    {
        try {
            $this->client->delete("{$this->baseUrl}/pet/{$id}");
        } catch (Exception $e) {
            throw new Exception('Error' . $e->getMessage());
        }
    }
}
