<?php

namespace Modules\Account\Http\Controllers;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Requests\DepartmentRequest;
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

        return inertia('Departments/Index', [
            'data' => [
                'branch' => DepartmentResource::collection($branches)->collection,
                'office' => DepartmentResource::collection($offices)->collection,
                'shop' => DepartmentResource::collection($shops)->collection
            ]
        ]);
    }

    public function create(): Response
    {
        $this->seo()->setTitle('Создать отдел');

        return inertia('Departments/Form', [
            'data' => [
                'types' => $this->repository->getTypes(),
                'users' => $this->repository->getUsers()
            ]
        ]);
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        $department = Department::create($request->only(['name', 'type']));
        $department->users()->sync($request->input('users'));

        return redirect()->route('account.departments.edit', $department->id)->with([
            'toast' => [
                'text' => "Отдел {$department->name} был создан."
            ]
        ]);
    }

    public function edit(int $id): Response
    {
        $department = $this->repository->findById($id);

        $this->seo()->setTitle('Редактировать отдел');

        $data = $department->only(['id', 'name', 'type']);
        $data['users'] = $department->users->pluck('id');

        return inertia('Departments/Form', [
            'data' => [
                'department' => $data,
                'types' => $this->repository->getTypes(),
                'users' => $this->repository->getUsers()
            ]
        ]);
    }

    public function update(DepartmentRequest $request, int $id): RedirectResponse
    {
        $department = $this->repository->findById($id);

        $department->update($request->only(['name', 'type']));
        $department->users()->sync($request->input('users'));

        return back()->with(['toast' => ['text' => "Отдел {$department->name} был отредактирован."]]);
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

        ['branches' => $branches, 'offices' => $offices, 'shops' => $shops] = $this->repository->getDepartmentsForIndex(
            fn(Builder $q) => $q->onlyTrashed()
        );

        return inertia('Departments/Index', [
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
