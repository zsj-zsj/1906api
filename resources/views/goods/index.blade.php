@foreach ($goods as $v)
    <a href="{{url('goods/goodslist')}}?goods_id={{$v->goods_id}}">{{$v->goods_name}}</a>
@endforeach