@foreach($freight_list as $k=>$v)
<option value="{{ $k }}" @if($freight_id == $k){{ 'selected="selected"' }}@endif>{{ $v == -1 ? "{$v}（￥{$freight_fee}）" : $v }}</option>
@endforeach