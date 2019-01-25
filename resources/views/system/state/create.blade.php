@extends('avored-framework::layouts.app')

@section('content')

    <div id="admin-state-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.state-create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.state.store') }}" method="post">
                        @csrf

                        @include('avored-framework::system.state._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.state-create') }}
                            </button>
                            <a href="{{ route('admin.state.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-state-page',
        data : {
            model: {},
            autofocus:true,
            disabled: false
           
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this.model[fieldName] = val;
            }
        }
    });

</script>


@endpush