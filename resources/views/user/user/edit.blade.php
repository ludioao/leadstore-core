@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::user.user-edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.user.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')


                            <a href="{!! route('admin.user.verifyAccount', $model->id) !!}">
                                {!! empty($model->email_verified_at) ? 'Verificar' : 'Invalidar' !!} conta e notificar usuário.
                            </a>


                        @include('avored-framework::user.user._fields')

                        <div class="mt-3 form-group">
                            <button class="btn btn-primary"
                                    type="submit">{{ __('avored-framework::user.user-edit') }}</button>
                            <a href="{{ route('admin.user.index') }}"
                               class="btn">{{ __('avored-framework::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
