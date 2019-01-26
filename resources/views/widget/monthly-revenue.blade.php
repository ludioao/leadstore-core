<div class="widget">
    <div class="dashboard-card" style="cursor: move;">
        <div class="title">
            {{ __('avored-framework::lang.admin-dashboard-monthly-revenue-title') }}
        </div>

        <div class="data">
            {{ $currencySymbol }}{{ $monthlyRevenue }}

            {{--<span class="progress">--}}
            {{--<span class="icon graph-up-icon"></span>--}}
            {{--0.0% Increased--}}
            {{--</span>--}}
        </div>
    </div>

</div>



