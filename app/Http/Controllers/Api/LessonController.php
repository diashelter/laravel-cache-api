<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    public function __construct(
        protected LessonService $lessonService
    )
    {
    }

    public function index(string $module): AnonymousResourceCollection
    {
        $lesson = $this->lessonService->getLessonsByModule($module);
        return LessonResource::collection($lesson);
    }

    public function store(StoreUpdateLesson $request, string $module): LessonResource
    {
        $module = $this->lessonService->createNewLesson($request->validated());
        return new LessonResource($module);
    }

    public function show(string $course, string $identify): LessonResource
    {
        $module = $this->lessonService->getLessonByModule($course, $identify);
        return new LessonResource($module);
    }

    public function update(StoreUpdateLesson $request, string $module, string $identify): JsonResponse
    {
        $this->lessonService->updateLesson($request->validated(), $identify);
        return response()->json(['message' => 'updated'], Response::HTTP_NO_CONTENT);
    }

    public function destroy(string $course, string $identify): JsonResponse
    {
        $this->lessonService->deletedLesson($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
