<?php

namespace LeadStore\Framework\Order\Controllers;

use LeadStore\Framework\System\Controllers\Controller;
use LeadStore\Framework\Models\Contracts\OrderReturnRequestInterface;
use LeadStore\Framework\Models\Database\OrderReturnRequest;
use LeadStore\Framework\Order\DataGrid\OrderReturnRequestDataGrid;

class OrderReturnRequestController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\OrderReturnRequestRepository
     */
    protected $repository;

    public function __construct(OrderReturnRequestInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderReturnGrid = new OrderReturnRequestDataGrid($this->repository->all());

        return view('avored-framework::order.return-request.index')
                    ->withDataGrid($orderReturnGrid->dataGrid);
    }

    /**
     * View an Order Details
     * @param \LeadStore\Framework\Models\Database\OrderReturnRequest $returnRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function view(OrderReturnRequest $returnRequest)
    {
        return view('avored-framework::order.return-request.view')
                ->withReturnRequest($returnRequest);
    }

    /**
     * Update an Order Return Request Details
     * @param \LeadStore\Framework\Models\Database\OrderReturnRequest $returnRequest
     * @param string $status
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(OrderReturnRequest $returnRequest, $status)
    {
        $returnRequest->update(['status' => $status]);
        return redirect()->route('admin.order-return-request.index');
    }
}
