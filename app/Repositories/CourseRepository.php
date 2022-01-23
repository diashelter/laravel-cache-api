<?php
declare (strict_types=1);

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class CourseRepository
{
    public function __construct(
        protected Course $course,
        protected \Illuminate\Cache\Repository $cache
    )
    {
    }

    public function getCoursesAll(): mixed
    {
        return $this->cache->rememberForever('courses', function () {
            return $this->course
                ->with('modules.lessons')
                ->get();
        });
    }

    public function createCourse(array $data)
    {
        $data['uuid'] = Str::uuid();
        return $this->course->create($data);
    }

    public function getCourseByIdentify(string $identify, bool $loadRelationsShip = true)
    {
        $query = $this->course->where('uuid', $identify);
        if ($loadRelationsShip) {
            $query->with('modules.lessons');
        }
        return $query->firstOrFail();
    }

    public function deleteCourseByIdentify(string $identify)
    {
        $course = $this->getCourseByIdentify($identify, false);
        $this->cache->forget('courses');
        return $course->delete();
    }

    public function updateCourseByIdentify(string $identify, array $data)
    {
        $course = $this->getCourseByIdentify($identify, false);
        $this->cache->forget('courses');
        return $course->update($data);
    }
}
