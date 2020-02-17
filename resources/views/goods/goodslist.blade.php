<table border="1">
    <tr>
        <td>ID</td>
        <td>商品名称</td>
    </tr>
    @foreach ($goods as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
    </tr>   
    @endforeach
</table>