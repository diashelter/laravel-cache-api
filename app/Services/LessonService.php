<?php
declare (strict_types = 1);

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ModuleRepository;

final class LessonService
{
    public function __construct(
        protected ModuleRepository $moduleRepository,
        protected LessonRepository $lessonRepository
    ) {}

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByIdentify($module);
        return $this->lessonRepository->getLessonsModule($module->id);
    }

    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByIdentify($data['module']);
        return $this->lessonRepository->createLesson($module->id, $data);
    }

    public function getLessonByModule(string $module, string $identify)
    {
        $module = $this->moduleRepository->getModuleByIdentify($module);
        return $this->lessonRepository->getLessonByModule($module->id, $identify);
    }

    public function deletedLesson(string $identify)
    {
        return $this->lessonRepository->deleteLessonByIdentify($identify);
    }

    public function updateLesson(array $data, string $identify)
    {
        $module = $this->moduleRepository->getModuleByIdentify($data['module']);
        return $this->lessonRepository->updateLessonByIdentify($module->id, $identify, $data);
    }
}
