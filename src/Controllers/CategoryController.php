<?php 

namespace App\Controllers;

use App\Core\Database\Database;
use App\Core\View;
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