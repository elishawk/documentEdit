<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentsAPIRequest;
use App\Http\Requests\API\UpdateDocumentsAPIRequest;
use App\Models\Documents;
use App\Repositories\DocumentsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class DocumentsAPIController
 */
class DocumentsAPIController extends AppBaseController
{
    private DocumentsRepository $documentsRepository;

    public function __construct(DocumentsRepository $documentsRepo)
    {
        $this->documentsRepository = $documentsRepo;
    }

    /**
     * Display a listing of the Documents.
     * GET|HEAD /documents
     */
    public function index(Request $request): JsonResponse
    {
        $documents = $this->documentsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($documents->toArray(), 'Documents retrieved successfully');
    }

    /**
     * Store a newly created Documents in storage.
     * POST /documents
     */
    public function store(CreateDocumentsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $documents = $this->documentsRepository->create($input);

        return $this->sendResponse($documents->toArray(), 'Documents saved successfully');
    }

    /**
     * Display the specified Documents.
     * GET|HEAD /documents/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Documents $documents */
        $documents = $this->documentsRepository->find($id);

        if (empty($documents)) {
            return $this->sendError('Documents not found');
        }

        return $this->sendResponse($documents->toArray(), 'Documents retrieved successfully');
    }

    /**
     * Update the specified Documents in storage.
     * PUT/PATCH /documents/{id}
     */
    public function update($id, UpdateDocumentsAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Documents $documents */
        $documents = $this->documentsRepository->find($id);

        if (empty($documents)) {
            return $this->sendError('Documents not found');
        }

        $documents = $this->documentsRepository->update($input, $id);

        return $this->sendResponse($documents->toArray(), 'Documents updated successfully');
    }

    /**
     * Remove the specified Documents from storage.
     * DELETE /documents/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Documents $documents */
        $documents = $this->documentsRepository->find($id);

        if (empty($documents)) {
            return $this->sendError('Documents not found');
        }

        $documents->delete();

        return $this->sendSuccess('Documents deleted successfully');
    }
}
