<?php
declare (strict_types = 1);

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

final class ModuleService
{
    public function __construct(
        protected ModuleRepository $moduleRepository,
        protected CourseRepository $courseRepository
    ) {}

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByIdentify($course);
        return $this->moduleRepository->getModulesCourse($course->id);
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByIdentify($data['course']);
        return $this->moduleRepository->createModule($course->id, $data);
    }

    public function getModuleByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByIdentify($course);
        return $this->moduleRepository->getModuleByCourse($course->id, $identify);
    }

    public function deletedModule(string $identify)
    {
        return $this->moduleRepository->deleteModuleByIdentify($identify);
    }

    public function updateModule(array $data, string $identify)
    {
        $course = $this->courseRepository->getCourseByIdentify($data['course']);
        return $this->moduleRepository->updateModuleByIdentify($course->id, $identify, $data);
    }
}
