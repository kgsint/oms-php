<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
use App\Http\FormRequests\CategoryStoreRequest;
use App\Http\FormRequests\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryController 
{
    private CategoryRepository $categoryRepo;

    public function __construct()
    {
        $this->categoryRepo = new CategoryRepository(new Database);
    }
    
    public function index(): View
    {
        return View::make('categories.index', [
            'categories' => $this->categoryRepo->getAll(),
        ]);
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
        $category->active = (int) isset($_POST['active']) ??  1;


        $this->categoryRepo->save($category);

        return redirect('/categories/new');
    }

    public function edit(): View
    {
        // return back if no category is found,
        if(!$category = $this->categoryRepo->find((int) $_GET['id'])) {
            return redirect('/categories');
        }

        return View::make('categories.edit', compact('category'));
    }

    public function update()
    {
        // validation
        CategoryUpdateRequest::validate($_POST);

        $category = $this->categoryRepo->find((int) $_POST['id']);

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