
<div class="card">
    <div class="card-title">
        Último Pedido
    </div>
    <div class="card-info ">

        @if(null === $recentOrderData)
            <p class="text-center">
                Não há registros de pedidos
            </p>
        @else

            <ul>
                <li>

                    <div class="description">
                        <div class="name">
                            {!! $recentOrderData['user'] !!}
                        </div>
                        <div class="info">
                            {!! $recentOrderData['product_count'] !!} produtos
                                                                      &nbsp;.&nbsp;
                                                                      Valor Total {!! $recentOrderData['total_amount'] !!}
                        </div>
                    </div>
                    <span class="icon angle-right-icon"></span></li>
            </ul>

        @endif




    </div>
</div>
