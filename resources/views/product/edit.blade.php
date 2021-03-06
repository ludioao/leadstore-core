@extends('avored-framework::layouts.app')

@section('content')
<div id="admin-product-edit-page">
        <div class="row">
            <div class="col-12">
                <div class="h1">Editar Produto</div>
            </div>
        </div>

        <?php
        $productCategories = $model->categories()->get()->pluck('id')->toArray();
        ?>

        {!! Form::open()->fill($model)->route('admin.product.update', [$model->id])->id('product-save-form')->multipart()->method('put') !!}

        <div class="row" id="product-save-accordion" data-children=".product-card">
            <div class="col-md-8">
                <div class="card product-card  mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#basic">
                        <div class="card-header">
                            {{ __('avored-framework::lang.basic_details') }}
                        </div>
                    </a>
                    <div class="card-body collapse show" id="basic">
                        @include('avored-framework::product.card.basic')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card  mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#categoriesTab">
                        <div class="card-header">
                            Categorias
                        </div>
                    </a>
                    <div class="card-body collapse show" id="categoriesTab">
                        @if(!isset($productCategories))
                            <?php $productCategories = []; ?>
                        @endif

                        @include('avored-framework::product.card.partials.categories')
                    </div>
                </div>
            </div>

            <div class="col-12 mb-2 mt-2">
                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#images">
                    <div class="card-header">
                        Imagens
                    </div>
                    </a>
                    <div class="card-body collapse" id="images">
                        @include('avored-framework::product.card.images')
                    </div>
                </div>


                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#seo">
                        <div class="card-header">SEO</div>
                    </a>
                    <div class="card-body collapse" id="seo">
                        @include('avored-framework::product.card.seo')
                    </div>
                </div>

                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#property">
                    <div class="card-header">
                        Propriedade
                    </div>
                    </a>
                    <div class="card-body collapse" id="property">
                        @include('avored-framework::product.card.property')
                    </div>
                </div>

                @if($model->hasVariation())

                    <div class="card product-card mb-2 mt-2">
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#attribute">
                            <div class="card-header">
                                Atributos
                            </div>
                        </a>
                        <div class="card-body collapse" id="attribute">
                            @include('avored-framework::product.card.attribute')
                        </div>
                    </div>

                @endif

                @if($model->type == "DOWNLOADABLE")

                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                    class="float-right" href="#downloadable">
                        <div class="card-header ">
                            Informações de Download
                        </div>
                    </a>
                    <div class="card-body collapse" id="downloadable">
                        @include('avored-framework::product.card.downloadable')
                    </div>
                </div>

                @endif

                @foreach(Tabs::all('product') as $key => $tab)

                    <div class="card product-card mb-2 mt-2">
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#{{ $key }}">
                        <div class="card-header">
                            {{ $tab->label }}
                        </div>
                        </a>
                        <div class="card-body collapse" id="{{ $key }}">
                            @include($tab->view)
                        </div>
                    </div>

                @endforeach


            </div>
        </div>

            <div class="form-group">
                <button type="button"
                        :disabled='isSaveButtonDisabled'
                        class="btn btn-primary"
                        name="save"
                        onclick="jQuery('#product-save-form').submit()">
                    Salvar
                </button>

                <button type="button"  class="btn" onclick="location='{{ route('admin.product.index') }}'">
                    Cancelar
                </button>
            </div>

        {!! Form::close() !!}
</div>
@endsection


