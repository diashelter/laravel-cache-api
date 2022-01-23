<?php
declare (strict_types=1);

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

final class LessonRepository
{
    public function __construct(
        protected Lesson $repository,
        protected \Illuminate\Cache\Repository $cache
    )
    {
    }

    public function getLessonsModule(int $moduleId)
    {
        return $this->repository
            ->where('module_id', $moduleId)
            ->get();
    }

    public function createLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;
        $data['uuid'] = Str::uuid();
        return $this->repository->create($data);
    }

    public function getLessonByModule(int $moduleId, string $identify)
    {
        return $this->repository
            ->where('module_id', $moduleId)
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function getLessonByIdentify(string $identify)
    {
        return $this->repository
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function deleteLessonByIdentify(string $identify)
    {
        $lesson = $this->getLessonByIdentify($identify);
        $this->cache->forget('courses');
        return $lesson->delete();
    }

    public function updateLessonByIdentify(int $moduleId, string $identify, array $data)
    {
        $lesson = $this->getLessonByIdentify($identify);
        $this->cache->forget('courses');
        $data['module_id'] = $moduleId;
        return $lesson->update($data);
    }
}
