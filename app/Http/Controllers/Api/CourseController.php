<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    )
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $courses = $this->courseService->getCourses();
        return CourseResource::collection($courses);
    }

    public function store(StoreUpdateCourse $request): CourseResource
    {
        $course = $this->courseService->createNewCourse($request->validated());
        return new CourseResource($course);
    }

    public function show(string $identify): CourseResource|JsonResponse
    {
        $course = $this->courseService->getCourse($identify);
        if (!$course) {
            return response()->json(['message' => 'Invalid Argument'], Response::HTTP_NOT_FOUND);
        }
        return new CourseResource($course);
    }

    public function update(StoreUpdateCourse $request, string $identify): \Illuminate\Http\JsonResponse
    {
        $this->courseService->updateCourse($request->validated(), $identify);
        return response()->json(['message' => 'updated'], Response::HTTP_OK);
    }

    public function destroy(string $identify): JsonResponse
    {
        $this->courseService->deletedCourse($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
