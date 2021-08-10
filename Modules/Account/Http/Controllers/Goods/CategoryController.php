<?php

namespace Modules\Account\Http\Controllers\Goods;

use App\Models\Goods\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\CategoryRequest;
use Modules\Account\Http\Resources\CategoryResource;
use Modules\Account\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepository $repository)
    {
    }

    public function index(): Response
    {
        $this->seo()->setTitle('Группы');

        $categories = $this->repository->getCategoriesForIndex();

        return inertia('Goods/Categories/Index', [
            'data' => [
                'categories' => CategoryResource::collection($categories)->collection,
            ]
        ]);
    }

    public function create(): Response
    {
        $this->seo()->setTitle('Создать категорию');

        return inertia('Goods/Categories/Form', [
            'data' => [
                'groups' => $this->repository->getGroups()
            ]
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->only(['groupId', 'name', 'number']);
        $data['group_id'] = $data['groupId'];

        $category = Category::create($data);

        return redirect()->route('account.categories.edit', $category->id)->with([
            'toast' => [
                'text' => "Группа {$category->name} была создана."
            ]
        ]);
    }

    public function edit(int $id): Response
    {
        $category = $this->repository->findById($id);

        $this->seo()->setTitle('Редактировать категорию');

        return inertia('Goods/Categories/Form', [
            'data' => [
                'category' => new CategoryResource($category),
                'groups' => $this->repository->getGroups()
            ]
        ]);
    }

    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $category = $this->repository->findById($id);

        $data = $request->only(['groupId', 'name', 'number']);
        $data['group_id'] = $data['groupId'];

        $category->update($data);

        return back()->with(['toast' => ['text' => "Группа {$category->name} была отредактирована."]]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = $this->repository->findById($id);

        try {
            $category->delete();
        } catch (\Exception) {
            return back()->with(['error' => 'Возникла ошибка при удалении категории.']);
        }

        return back()->with(['toast' => ['text' => "Группа $category->name была удалена."]]);
    }
}
