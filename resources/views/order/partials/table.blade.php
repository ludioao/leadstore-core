<div class="mt-3 card">
	<div class="card-body">
		<table class="table">
			<thead>
			<tr>
				<th>SKU</th>
				<th>{{ __('avored-framework::lang.name') }}</th>
				<th>{{ __('avored-framework::lang.qty') }}</th>
				<th>{{ __('avored-framework::lang.price') }}</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			@foreach($order->products as $product)
				@php
					$productInfo = json_decode($product->getRelationValue('pivot')->product_info);
				@endphp
				<tr>
					<td>{!! $product->sku !!}</td>
					<td>
						{{ $productInfo->name }}


						@if($productInfo->type == "VARIATION")
							@foreach($order->orderProductVariation as $orderProductVariation)
								<p>
									{{ $orderProductVariation->attribute->name }}:
									{{   $orderProductVariation->attributeDropdownOption->display_text }}
								</p>
							@endforeach
						@endif

					</td>
					<td> {{ $product->getRelationValue('pivot')->qty }} </td>
					<td> {{ number_format($product->getRelationValue('pivot')->price, 2, ',', '.') }} </td>
					<td> {{ number_format($total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty, 2, ',', '.') }} </td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
