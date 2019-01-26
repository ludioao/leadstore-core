@extends('avored-framework::layouts.app')

@section('content')

	<div class="dashboard-stats">

		<div class="widget-column" ondrop="drop(event)" ondragover="allowDrop(event)">
			<div class="widget-wrapper">
				<div class="widget mt-3 mb-3" id="widget-{{ Widget::get('total-user')->identifier() }}"
					 draggable="true" ondragstart="drag(event)">
					@include (Widget::get('total-user')->view(),Widget::get('total-user')->with())
				</div>
			</div>
		</div>

		<div class="widget-column" ondrop="drop(event)" ondragover="allowDrop(event)">
			<div class="widget-wrapper">
				<div class="widget mt-3 mb-3"
					 id="widget-{{ Widget::get('monthly-revenue')->identifier() }}"
					 draggable="true" ondragstart="drag(event)">
					@include (Widget::get('monthly-revenue')->view(),Widget::get('monthly-revenue')->with())
				</div>
			</div>
		</div>


		<div class="widget-column" ondrop="drop(event)" ondragover="allowDrop(event)">
			<div class="widget-wrapper">
				<div class="widget mt-3 mb-3" id="widget-{{ Widget::get('total-order')->identifier() }}"
					 draggable="true" ondragstart="drag(event)">
					@include (Widget::get('total-order')->view(),Widget::get('total-order')->with())
				</div>
			</div>
		</div>

	</div>

	<div class="sale-stock">
		{{--<div class="card">--}}
			{{--<div class="card-title">--}}
				{{--Produtos mais vendidos--}}
			{{--</div>--}}
			{{--<div class="card-info ">--}}
				{{--<ul class="ml-auto pl-0">--}}
					{{--<li><a href="#">--}}
							{{--<div class="product image"><img--}}
										{{--src="#"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--Apple iPhone 7--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--1 venda--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
				{{--</ul>--}}
			{{--</div>--}}
		{{--</div>--}}

		@include (Widget::get('recent-order')->view(),Widget::get('recent-order')->with())

		{{--<div class="card">--}}
			{{--<div class="card-title">--}}
				{{--Stock Threshold--}}
			{{--</div>--}}
			{{--<div class="card-info ">--}}
				{{--<ul>--}}
					{{--<li><a href="https://demo.bagisto.com/bagisto-187-23-208-137/admin/catalog/products/edit/1">--}}
							{{--<div class="image"><img--}}
										{{--src="https://demo.bagisto.com/bagisto-187-23-208-137/cache/small/product/1/tsN5KPBx0FpJnWdnGAeA6mf6kVgxNBCtSWRDSKde.jpeg"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--T Shirt Black--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--3 Left--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
					{{--<li><a href="https://demo.bagisto.com/bagisto-187-23-208-137/admin/catalog/products/edit/18">--}}
							{{--<div class="image"><img--}}
										{{--src="https://demo.bagisto.com/bagisto-187-23-208-137/cache/small/product/18/oFocPvzqvqLl1BxETz2i0hXzB3ywhzycELQv9bs1.jpeg"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--Red Bag--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--5 Left--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
					{{--<li><a href="https://demo.bagisto.com/bagisto-187-23-208-137/admin/catalog/products/edit/2">--}}
							{{--<div class="image"><img--}}
										{{--src="https://demo.bagisto.com/bagisto-187-23-208-137/cache/small/product/2/y2YcgMkSNQTyJVc5a5FQbryBGto13APuc2AwEAUR.jpeg"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--T Shirt Navy Blue--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--7 Left--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
					{{--<li><a href="https://demo.bagisto.com/bagisto-187-23-208-137/admin/catalog/products/edit/6">--}}
							{{--<div class="image"><img--}}
										{{--src="https://demo.bagisto.com/bagisto-187-23-208-137/themes/default/assets/images/product/small-product-placeholder.png"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--Iphone 7 Black 64GB--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--8 Left--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
					{{--<li><a href="https://demo.bagisto.com/bagisto-187-23-208-137/admin/catalog/products/edit/9">--}}
							{{--<div class="image"><img--}}
										{{--src="https://demo.bagisto.com/bagisto-187-23-208-137/themes/default/assets/images/product/small-product-placeholder.png"--}}
										{{--class="item-image"></div>--}}
							{{--<div class="description">--}}
								{{--<div class="name">--}}
									{{--Iphone 7 White 256GB--}}
								{{--</div>--}}
								{{--<div class="info">--}}
									{{--11 Left--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<span class="icon angle-right-icon"></span></a></li>--}}
				{{--</ul>--}}
			{{--</div>--}}
		{{--</div>--}}
	</div>





@endsection

@push('scripts')
	<script>
        $(function () {


        });

        function allowDrop(ev) {

            ev.preventDefault();
        }

        function drag(ev) {

            var draggableElementId = jQuery(ev.target).prop('id');
            ev.dataTransfer.setData("elementId", draggableElementId);
        }

        function drop(ev) {
            ev.preventDefault();

            var widgetId = ev.dataTransfer.getData("elementId");
            var widgetContent = jQuery("#" + widgetId).parent().html();

            if (jQuery(ev.target).hasClass('empty-widget')) {
                jQuery(ev.target).parents('.widget-column:first').html("");
            }

            if (jQuery(ev.target).hasClass('widget-column')) {

                jQuery("#" + widgetId).parent().remove();
                jQuery(ev.target).append("<div class='widget-wrapper'>" + widgetContent + "</div>");


            } else {
                jQuery("#" + widgetId).parent().remove();
                jQuery(ev.target).parents('.widget-column:first').append("<div class='widget-wrapper'>" + widgetContent + "</div>");
            }

        }


	</script>
@endpush
