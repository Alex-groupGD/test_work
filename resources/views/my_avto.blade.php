@extends('yaled.pattern')


@section('title-block')
    Машины {{$user->family}}
    {{isset($message) ? $message : Null  }}
@endsection

@section('content')

    <h1>Машины {{$user->family}}</h1>

    @foreach($avtos as $avto=>$value)
        <div class="row">
            <ul class="list-group">

                <li class="list-group-item">
                             {{$value->marka}} {{$value->model}} {{$value->color}} {{$value->gos_num}}



                    <form method="POST" action="{{route('avtos.destroy' ,  $value->id )  }}">
                        @csrf()
                        <a href="{{route('ss' , $value->id)}}" class="btn  btn-secondary fw-bold border-white bg-dark">Изменить</a>


                        @method('DELETE')
                        <button type="submit" class="btn  btn-secondary fw-bold border-white bg-dark">Удалить</button>

                    </form>
                </li>
            </ul>
        </div>
    @endforeach
    <a href="{{route('avtos.create',$user) }}" class="btn  btn-secondary fw-bold border-white bg-dark m-5   ">Добавить автомобиль</a>
@endsection
