<div class="card mt-3">
	<div class="card-header text-white bg-secondary">{{  __('avored-framework::orders.other-data') }}</div>
	<div class="card-body">
		<table class="table">
			<tr>
				<th>Opção de Frete</th>
				<td><span class="badge badge-info"> {{ $order->shipping_option }} </span></td>
			</tr>
			<tr>
				<th>Valor do Frete</th>
				<td>{{ $order->shipping_cost > 0 ? 'R$ ' . $order->shipping_cost : '-' }} </td>
			</tr>
			@if ($order->coupon_id)
				<tr>
					<th>Desconto (Cupom)</th>
					<td>{!! $order->discount_total !!} ({!! \LeadStore\Discount\Models\Database\Coupon::find($order->coupon_id)->code !!})</td>
				</tr>
			@endif
			<tr>
				<th>Método de Pagamento</th>
				<td>{{ $order->payment_option }}</td>
			</tr>
		</table>
	</div>
</div>
