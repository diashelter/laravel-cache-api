<?php
declare (strict_types=1);

namespace App\Repositories;

use App\Models\Module;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

final class ModuleRepository
{
    public function __construct(
        protected Module $module,
        protected \Illuminate\Cache\Repository $cache
    )
    {
    }

    public function getModulesCourse(int $courseId)
    {
        return $this->module
            ->where('course_id', $courseId)
            ->get();
    }

    public function createModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;
        $data['uuid'] = Str::uuid();
        return $this->module->create($data);
    }

    public function getModuleByCourse(int $courseId, string $identify)
    {
        return $this->module
            ->where('course_id', $courseId)
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function getModuleByIdentify(string $identify)
    {
        return $this->module
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function deleteModuleByIdentify(string $identify)
    {
        $module = $this->getModuleByIdentify($identify);
        $this->cache->forget('courses');
        return $module->delete();
    }

    public function updateModuleByIdentify(int $courseId, string $identify, array $data)
    {
        $module = $this->getModuleByIdentify($identify);
        $this->cache->forget('courses');
        $data['course_id'] = $courseId;
        return $module->update($data);
    }
}
