<?php 

namespace App\Controllers;

use App\Contracts\OrderRepositoryInterface;
use App\Core\App;
use App\Core\View;
use App\Models\Order;

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
            'orders' => $this->orderRepo->getWithProductAndUser(),
        ]);
    }

    public function update()
    {
        $id = (int) $_POST['id'];

        if(! $order = $this->orderRepo->find($id)) {
            abort(404);
        }

        // set status
        $order->status = (int) $_POST['status'];
        // update
        $this->orderRepo->save($order);

        return redirectBack();
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