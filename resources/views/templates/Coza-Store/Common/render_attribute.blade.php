@if (!empty($details) && count($details))
    @foreach ($details as $groupId => $detailsGroup)    
    <div class="flex-w flex-r-m p-b-10">
        <div class="size-203 flex-c-m respon6">
          {!! $groups[$groupId]['name']??'Not found' !!}
        </div>
        <div class="size-204 respon6-next attributes" name="{{$groups[$groupId]['name']}}">
            @switch($groups[$groupId]['type'])
                @case('select')
                <div class="rs1-select2 bor8 bg0">
                    <select class="js-select2 {{$groups[$groupId]['name']}}__" name="form_attr[{{ $groupId }}]" 
                    onChange="ChangeAttibutes(this,'{{$groups[$groupId]['name']}}')">
                    <option data-type="" data-images="false" value="0">Choose {!! $groups[$groupId]['name']??'Not found' !!}</option>
                        @foreach ($detailsGroup as $k => $detail)
                            @php
                                $valueOption = $detail->name.'__'.$detail->add_price;
                                $images = $detail->images;
                                $data = '';
                                $type_show = $detail->type_show;
                                if ($images) {
                                    $image_count = explode(',', $images);
                                    if ($type_show == 'threesixty') {
                                        $threesixty = bc_get_threesixty_image($image_count);
                                        $data = 'data-path='.$threesixty['path'].'/ 
                                                data-name='.$threesixty['file_name'].'
                                                data-ext='.$threesixty['extension'].'
                                                data-amount='.count($image_count).'';
                                    }else{
                                        $data = 'data-images='.implode(',',$image_count);
                                    }
                                }else{
                                    $data = "data-images=false";
                                }
                            @endphp
                            <option
                                data-type="{{ $type_show }}"  
                                {{ $data }}
                                value="{{$valueOption}}">{{$detail->name}}</option>
                        @endforeach
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                    @break
                @case('radio')
                    
                    @break
                @case('checkbox')

                    @break
                @default
            @endswitch
        </div>
    </div>
    @endforeach
@endif


