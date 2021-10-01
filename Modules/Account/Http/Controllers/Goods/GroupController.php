<?php

namespace Modules\Account\Http\Controllers\Goods;

use App\Models\Goods\Group;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\GroupRequest;
use Modules\Account\Http\Resources\GroupResource;
use Modules\Account\Repositories\GroupRepository;

class GroupController extends Controller
{
    public function __construct(protected GroupRepository $repository)
    {
    }

    public function index(): Response
    {
        $this->seo()->setTitle('Направления');

        $groups = $this->repository->getGroupsForIndex();

        return inertia('Goods/Groups/Index', [
            'data' => [
                'groups' => GroupResource::collection($groups)->collection,
            ]
        ]);
    }

    public function create(): Response
    {
        $this->seo()->setTitle('Создать группу');

        return inertia('Goods/Groups/Form');
    }

    public function store(GroupRequest $request): RedirectResponse
    {
        $group = Group::create($request->only(['name']));

        return redirect()->route('account.groups.edit', $group->id)->with([
            'toast' => [
                'text' => "Группа {$group->name} была создана."
            ]
        ]);
    }

    public function edit(int $id): Response
    {
        $group = $this->repository->findById($id);

        $this->seo()->setTitle('Редактировать группу');

        return inertia('Goods/Groups/Form', [
            'data' => [
                'group' => new GroupResource($group),
            ]
        ]);
    }

    public function update(GroupRequest $request, int $id): RedirectResponse
    {
        $group = $this->repository->findById($id);

        $group->update($request->only(['name']));

        return back()->with(['toast' => ['text' => "Группа {$group->name} была отредактирована."]]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $group = $this->repository->findById($id);

        try {
            $group->delete();
        } catch (\Exception) {
            return back()->with(['error' => 'Возникла ошибка при удалении направления.']);
        }

        return back()->with(['toast' => ['text' => "Группа $group->name была удалена."]]);
    }
}
