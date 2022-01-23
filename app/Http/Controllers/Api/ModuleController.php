<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Models\Course;
use App\Services\ModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    public function __construct(
        protected ModuleService $moduleService
    )
    {
    }

    public function index(string $course): AnonymousResourceCollection
    {
        $module = $this->moduleService->getModulesByCourse($course);
        return ModuleResource::collection($module);
    }

    public function store(StoreUpdateModule $request, string $course): ModuleResource
    {
        $module = $this->moduleService->createNewModule($request->validated());
        return new ModuleResource($module);
    }

    public function show(string $course, string $identify): ModuleResource
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);
        return new ModuleResource($module);
    }

    public function update(StoreUpdateModule $request, string $course, string $identify): JsonResponse
    {
        $this->moduleService->updateModule($request->validated(), $identify);
        return response()->json(['message' => 'updated'], Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $course, string $identify): JsonResponse
    {
        $this->moduleService->deletedModule($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
