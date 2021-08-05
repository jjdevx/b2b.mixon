<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Resources\DepartmentResource;
use Modules\Account\Repositories\DepartmentRepository;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentRepository $repository)
    {
    }

    public function index(): Response
    {
        $this->seo()->setTitle('Отделы');

        ['branches' => $branches, 'offices' => $offices, 'shops' => $shops] = $this->repository->getDepartmentsForIndex();

        return inertia('Departments', [
            'data' => [
                'branches' => DepartmentResource::collection($branches)->collection,
                'offices' => DepartmentResource::collection($offices)->collection,
                'shops' => DepartmentResource::collection($shops)->collection
            ]
        ]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $department = $this->repository->findById($id);

        try {
            $department->delete();
        } catch (\Exception) {
            return back()->with(['error' => 'Возникла ошибка при удалении отдела.']);
        }

        return back()->with(['toast' => ['text' => "Отдел $department->name был удален."]]);
    }

    public function trash(): Response
    {
        $this->seo()->setTitle('Удаленные отделы');

        ['branches' => $branches, 'offices' => $offices, 'shops' => $shops] = $this->repository->getDepartmentsForIndex(fn(Builder $q) => $q->onlyTrashed());

        return inertia('Departments', [
            'data' => [
                'branches' => DepartmentResource::collection($branches)->collection,
                'offices' => DepartmentResource::collection($offices)->collection,
                'shops' => DepartmentResource::collection($shops)->collection
            ]
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        $department = $this->repository->findById($id);
        if ($department->trashed()) {
            $department->restore();
        }
        return back()->with(['toast' => ['text' => "Отдел $department->name был восстановлен."]]);
    }

    public function forceDestroy(int $id): RedirectResponse
    {
        $department = $this->repository->findById($id);
        if ($department->trashed()) {
            $department->forceDelete();
        }
        return back()->with(['toast' => ['text' => "Отдел $department->name был удален окончательно."]]);
    }
}
