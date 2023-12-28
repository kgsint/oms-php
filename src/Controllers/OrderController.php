<?php 

namespace App\Controllers;

use App\Contracts\OrderRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Core\App;
use App\Core\View;

class OrderController 
{
    private OrderRepositoryInterface $orderRepo;

    public function __construct()
    {
        $this->orderRepo = App::resolve(OrderRepositoryInterface::class);
    }

    public function index()
    {
        return View::make('orders.index', [
            'orders' => $this->orderRepo->getWithProduct(),
        ]);
    }

    public function delete()
    {
        $id = (int) $_POST['id'];

        if(! $order = $this->orderRepo->find($id)) {
            abort(404);
        }

        // delete order
        $this->orderRepo->delete($order);

        return redirect('/orders');
    }
}