<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BioLinksResource;
use App\Services\BioLinksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BioLinksController extends Controller
{
    protected BioLinksService $bioLinksService;

    public function __construct(BioLinksService $bioLinksService)
    {
        $this->service = $bioLinksService;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $links = $this->service->allLinks();
        return BioLinksResource::collection($links);
    }

    public function show($identify): BioLinksResource
    {
        $link = $this->service->getlinkByUuid($identify);

        return new BioLinksResource($link);
    }

    public function create (Request $request) : JsonResponse
    {
        $link = $this->service->createLink($request->all());

        return response()->json([], 201);
    }

    public function update(Request $request, string $identify): JsonResponse
    {
        $link = $this->service->updateLink($request->all(), $identify);

        return response()->json(['data' => 'Dados atualizados com sucesso.'], 201);
    }
}
