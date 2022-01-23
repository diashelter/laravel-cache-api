<?php
declare (strict_types = 1);

namespace App\Services;

use App\Repositories\CourseRepository;

final class CourseService
{
    public function __construct(
        protected CourseRepository $courseRepository
    ) {}

    public function getCourses(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->courseRepository->getCoursesAll();
    }

    public function createNewCourse(array $data)
    {
        return $this->courseRepository->createCourse($data);
    }

    public function getCourse(string $identify)
    {
        return $this->courseRepository->getCourseByIdentify($identify);
    }

    public function deletedCourse(string $identify)
    {
        return $this->courseRepository->deleteCourseByIdentify($identify);
    }

    public function updateCourse(array $data, string $identify)
    {
        return $this->courseRepository->updateCourseByIdentify($identify, $data);
    }
}
