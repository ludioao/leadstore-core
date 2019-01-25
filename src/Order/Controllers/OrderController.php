<?php

namespace LeadStore\Framework\Order\Controllers;

use LeadStore\Framework\Order\Services\OrderService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use LeadStore\Framework\Models\Database\User;
use LeadStore\Framework\Models\Database\Order as Model;
use LeadStore\Framework\Models\Database\OrderStatus;
use LeadStore\Framework\Mail\OrderInvoicedMail;
use LeadStore\Framework\Mail\UpdateOrderStatusMail;
use LeadStore\Framework\Order\DataGrid\OrderDataGrid;
use LeadStore\Framework\Order\Requests\UpdateOrderStatusRequest;
use LeadStore\Framework\Order\Requests\UpdateTrackCodeRequest;
use LeadStore\Framework\Models\Contracts\OrderInterface;
use LeadStore\Framework\Models\Contracts\OrderHistoryInterface;
use LeadStore\Framework\System\Controllers\Controller;

class OrderController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\OrderRepository
     */
    protected $repository;

    public function __construct(OrderInterface $repository, OrderService $orderService)
    {
        $this->repository = $repository;
        $this->service = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderGrid = new OrderDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::order.index')->with('dataGrid', $orderGrid->dataGrid);
    }

    /**
     * View an Order Details
     * @param \LeadStore\Framework\Models\Database\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Model $order)
    {
        $orderStatus = OrderStatus::all()->pluck('name', 'id');
        return view('avored-framework::order.view')->with('order', $order)->with('orderStatus', $orderStatus);
    }

    /**
     * Send an Order Invioced PDF to User
     *
     * @param \LeadStore\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmailInvoice(Model $order)
    {
        if ($this->service->sendEmailInvoice($order))
        {
            return redirect()->back()->with('notificationText', 'E-mail enviado com sucesso');
        }
        return redirect()->back()->with('notificationText', 'Falha ao enviar e-mail');
    }

    /**
     * Edit the Order Status View
     *
     * @param \LeadStore\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\Response
     */
    public function editStatus(Model $order)
    {
        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('avored-framework::order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    /**
     * Change the Order Status
     *
     * @param \LeadStore\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Model $order, UpdateOrderStatusRequest $request)
    {
        //$order = Model::find($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

        $orderHistoryRepository = app(OrderHistoryInterface::class);
        $orderHistoryRepository->create(['order_id' => $order->id, 'order_status_id' => $request->get('order_status_id')]);

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }

    /**
     * Change the Order Status
     *
     * @param \LeadStore\Framework\Models\Database\Order $order
     * @param \LeadStore\Framework\Order\Request\UpdateTrackCodeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTrackCode(Model $order, UpdateTrackCodeRequest $request)
    {
        $order->update(['track_code' => $request->track_code]);

        //Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
