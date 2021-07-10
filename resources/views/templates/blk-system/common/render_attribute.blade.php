@if (!empty($details) && count($details))
    @foreach ($details as $groupId => $detailsGroup)
    <div class="col-lg-4 col-md-4 col-sm-6">
        <label>Select {!! $groups[$groupId]??'Not found' !!}</label>
        <div class="dropdown bootstrap-select">
            <select class="selectpicker" data-style="btn btn-warning btn-simple" data-size="7" tabindex="-98">
                <option disabled="" selected="">Choose {!! $groups[$groupId]??'Not found' !!}</option>
                @foreach ($detailsGroup as $k => $detail)
                    @php
                        $valueOption = $detail->name.'__'.$detail->add_price;
                    @endphp
                    <option value="{{$valueOption}}">{!! sc_render_option_price($valueOption) !!}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endforeach
@endif


