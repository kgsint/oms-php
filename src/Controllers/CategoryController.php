<?php 

namespace App\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Core\App;
use App\Core\View;
use App\Http\FormRequests\CategoryStoreRequest;
use App\Http\FormRequests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController 
{
    private CategoryRepositoryInterface $categoryRepo;

    public function __construct()
    {
        $this->categoryRepo = App::resolve(CategoryRepositoryInterface::class);
    }
    
    public function index(): View
    {
        $categories = $this->categoryRepo->getAll();
        // when search
        if(! empty($_GET['s'])) {
            $categories = $this->categoryRepo->search($_GET['s']);
        }

        return View::make('categories.index', compact('categories'));
    }

    public function create()
    {
        return View::make('categories.create');
    }

    public function store()
    {
        // validation
        CategoryStoreRequest::validate($_POST);

        // dd((int) isset($_POST['active']) ?? 1, true);

        $category = new Category;
        $category->name = $_POST['name'];
        $category->slug = convertToSlug($_POST['name']);
        $category->active = (int) isset($_POST['active']);


        $this->categoryRepo->save($category);

        return redirect('/categories/new');
    }

    public function edit(): View
    {
        // return 404 page if no category is found,
        if(!$category = $this->categoryRepo->find((int) $_GET['id'])) {
            abort(404);
        }

        return View::make('categories.edit', compact('category'));
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        // return 404 page if no category is found,
        if(!$category = $this->categoryRepo->find($id)) {
            abort(404);
        }
        // validation
        CategoryUpdateRequest::validate($_POST);

        $category->name = $_POST['name'];
        $category->active = (int) isset($_POST['active']) ??  1;

        $this->categoryRepo->save($category);

        return redirect('/categories');
    }

    public function destroy()
    {
        $id = (int) $_POST['id'];

        // return back if not found
        if(! $category = $this->categoryRepo->find($id)) {
            http_response_code(404);
            return redirect('/categories');
        }

        // delete
        $this->categoryRepo->delete($category);

        return redirect('/categories');
    }

}