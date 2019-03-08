@extends('avored-framework::layouts.app')
@section('content')


    <a href="{!! route('admin.user.verifyAccount', $user->id) !!}"
       class="mb-3 btn btn-{!! empty($user->email_verified_at) ? 'success' : 'danger' !!}">
        {!! empty($user->email_verified_at) ? 'Verificar' : 'Invalidar' !!} conta e notificar usuário.
    </a>

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header h4">
                    {{ __('avored-framework::user.user-details') }}
                </div>

                <div class="card-body table-bordered">
                    <table class="table">
                        <tr>
                            <td>{{ __('avored-framework::lang.name') }}</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>

                        <tr>
                            <td>Sobrenome</td>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        {{--<tr>--}}
                        {{--<td>Telefone</td>--}}
                        {{--<td>{{ $user->phone }}</td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>Empresa</td>
                            <td>{{ $user->company_name }}</td>
                        </tr>

                    </table>


                    <div class="row">
                        <div class="col-12">
                            <div class="h4">Pedidos</div>
                            <div class="user-orders-datagrid">
                                {!! DataGrid::render($userOrderDataGrid) !!}
                            </div>
                        </div>
                    </div>


                    <div class="float-left">

                        <a class="btn btn-warning" href="{{ route('admin.user.change-password', $user->id) }}">
                            Alterar Senha
                        </a>

                        <form method="post" class="d-inline" action="{{ route('admin.user.destroy', $user->id)  }}">
                            @csrf()
                            @method('delete')
                            <button
                                    onClick="event.preventDefault();
                                            swal({
                                            dangerMode: true,
                                            title: '{{ __('avored-framework::lang.are-you-sure') }}',
                                            icon: 'warning',
                                            buttons: true,
                                            text: 'Once deleted, you will not be able to recover this User!',
                                            }).then((willDelete) => {
                                            if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                            }
                                            });"
                                    class="btn btn-danger" >
                                Excluir
                            </button>
                        </form>

                    </div>
                    <a class="btn" href="{{ route('admin.user.index') }}">{{ __('avored-framework::lang.cancel') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <div id="accordion">

                        @foreach($addresses as $address)
                            <div class="card">
                                <div class="card-header" id="heading{!! $address->id !!}">
                                    <h5 class="mb-0">
                                        <span data-toggle="collapse" data-target="#collapse{!! $address->id !!}" aria-expanded="false" aria-controls="collapse{!! $address->id !!}">
                                            @if($address->type == "SHIPPING")
                                                <span>Endereço de Entrega</span>
                                            @else
                                                <span>Endereço de Cobrança</span>
                                            @endif
                                        </span>
                                    </h5>
                                </div>

                                <div id="collapse{!! $address->id !!}" class="collapse" aria-labelledby="heading{!! $address->id !!}" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul class="list-unstyled d-flex flex-column justify-content-around">
                                            <li>
                                                <strong>Nome </strong>
                                                {!! $address->first_name !!}
                                            </li>
                                            <li>
                                                <strong>Sobrenome </strong>
                                                {!! $address->last_name !!}
                                            </li>
                                            <li>
                                                <strong>Endereço </strong>
                                                {!! $address->address1 !!} - {!! $address->address_number !!}
                                                @if (!empty($address->address_complement))
                                                                           ({!! $address->address_complement !!})
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Bairro </strong>
                                                {!! $address->address2 !!}
                                            </li>
                                            <li>
                                                <strong>Cidade / Estado </strong>
                                                {!! $address->city !!} - {!! $address->state !!}
                                            </li>
                                            <li>
                                                <strong>Telefone </strong>
                                                {!! $address->phone !!}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop
