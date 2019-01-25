<?php

namespace LeadStore\Framework\System\Controllers;

use LeadStore\Framework\Models\Contracts\OrderInterface;
use LeadStore\Framework\Models\Contracts\UserInterface;

class DashboardController extends Controller
{
    /**
     *
     * @var \LeadStore\Framework\Models\Repository\OrderRepository
     */
    protected $repository;

    public function __construct(OrderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalRegisteredUser = app(UserInterface::class)->all();
        $totalOrder = $this->repository->all()->count();

        return view('avored-framework::home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('totalOrder', $totalOrder);
    }
}
