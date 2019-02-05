<div class="row">
    <div class="col-md-12">
        {!! Form::text('name', 'Título do Produto')->required() !!}
    </div>
</div>



<div class="row">
    <div class="col-md-4">
        {!! Form::text('slug', 'Slug')->required() !!}
    </div>
    <div class="col-md-4">
        {!! Form::text('sku', 'SKU')->required() !!}
    </div>
    <div class="col-md-4">
        @include('avored-framework::forms.select',['name' => 'is_featured','label' => 'Favorito', 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
    </div>
</div>

{!! Form::textarea('description', 'Description')->attrs(['class' => 'summernote'])->id('description')->required() !!}

<div class="row">
    @if($model->type == "VARIATION")
        <div class="col-6">
            {!! Form::text('price' , __('avored-framework::product.basic.base_price') . ' (R$)')->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true']) !!}
        </div>
    @else
        <div class="col-6">
            {!! Form::text('price' , __('avored-framework::lang.price') . ' (R$)')->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
        </div>
    @endif
    <div class="col-6">
        {!! Form::text('cost_price' , __('avored-framework::product.basic.cost_price') . ' (R$)')->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
        {!! Form::text('regular_price' , 'Preço de Varejo'  . ' (R$)')->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
    </div>
</div>


<div class="row">
    <div class="col-6">
        {!! Form::text('qty', __('avored-framework::product.basic.qty'))->type('number') !!}
    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'in_stock','label' => __('avored-framework::product.basic.in_stock'), 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'track_stock','label' => 'Gerenciar Estoque', 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])

    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'is_taxable','label' => __('avored-framework::product.basic.is_taxable'), 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
    </div>
</div>


@if($model->type !== "DOWNLOADABLE")
    <div class="row">
        <div class="col-md-6">
            @include('avored-framework::forms.text',['name' => 'weight','label' =>  'Peso', 'append' => 'Kg'])
        </div>
        <div class="col-md-6">
            @include('avored-framework::forms.select',['name' => 'status','label' => 'Ativo', 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
        </div>


    </div>

    <div class="row">
        <div class="col-md-4">
            @include('avored-framework::forms.text',['name' => 'width','label' =>  'Largura', 'append' => 'cm'])
        </div>
        <div class="col-md-4">
            @include('avored-framework::forms.text',['name' => 'height','label' =>  'Altura', 'append' => 'cm'])
        </div>
        <div class="col-md-4">
            @include('avored-framework::forms.text',['name' => 'length','label' =>  'Comprimento', 'append' => 'cm'])
        </div>
    </div>
@endif
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({element: document.getElementById("description")});

        $(function() {

            $('.category-checkbox-field').change(checkboxChanged);

            function checkboxChanged() {
                var $this = $(this),
                    checked = $this.prop("checked"),
                    container = $this.parent(),
                    siblings = container.siblings();

                container.find('input[type="checkbox"]')
                    .prop({
                        indeterminate: false,
                        checked: checked
                    })
                    .siblings('label')
                    .removeClass('custom-checked custom-unchecked custom-indeterminate')
                    .addClass(checked ? 'custom-checked' : 'custom-unchecked');

                checkSiblings(container, checked);
            }

            function checkSiblings($el, checked) {
                var parent = $el.parent().parent(),
                    all = true,
                    indeterminate = false;

                $el.siblings().each(function() {
                    return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                });

                if (all && checked) {
                    parent.children('input[type="checkbox"]')
                        .prop({
                            indeterminate: false,
                            checked: checked
                        })
                        .siblings('label')
                        .removeClass('custom-checked custom-unchecked custom-indeterminate')
                        .addClass(checked ? 'custom-checked' : 'custom-unchecked');

                    checkSiblings(parent, checked);
                }
                else if (all && !checked) {
                    indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

                    parent.children('input[type="checkbox"]')
                        .prop("checked", checked)
                        .prop("indeterminate", indeterminate)
                        .siblings('label')
                        .removeClass('custom-checked custom-unchecked custom-indeterminate')
                        .addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

                    checkSiblings(parent, checked);
                }
                else {
                    $el.parents("li").children('input[type="checkbox"]')
                        .prop({
                            indeterminate: true,
                            checked: false
                        })
                        .siblings('label')
                        .removeClass('custom-checked custom-unchecked custom-indeterminate')
                        .addClass('custom-indeterminate');
                }
            }
        });
    </script>
@endpush
