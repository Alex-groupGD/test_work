@extends('yaled.pattern')


@section('title-block')
    {{isset($user) ? 'Изменение данных'.$user->name : 'Регистрация'}}

@endsection
@section('title')
    {{isset($user) ? 'Изменение данных' ." ".$user->name : 'Регистрация' }}
@endsection

@section('content')

    <form method="POST"
          @if(isset($user))
            action="{{route('users.update', $user)}}" >
        @csrf
          @else
            action="{{route('users.store')}}" >
            @csrf
        @endif



             @isset($user)
                 @method('put')
              @endisset




            <div class="container">
                <div class="row">
                    <div class="col-sm">



            <div class="form-group ">
                <label for="formGroupExampleInput">Фамилия</label>
                <input type="text" name="family"
                       value="{{old('family',isset($user) ? $user->family : null)}}"
                       class="form-control " id="formGroupExampleInput" placeholder="Введите фамилию">
                        @error('family')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Имя</label>
                <input type="text" name="name"
                       value="{{old('name',isset($user) ? $user->name : null)}}"
                       class="form-control" id="formGroupExampleInput2" placeholder="Введите Имя">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Отчество</label>
                <input type="text" name="name_father"
                       value="{{old('name_father',isset($user) ? $user->name_father : null)}}"
                       class="form-control" id="formGroupExampleInput2" placeholder="Введите Отчество">
                        @error('name_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Телефон</label>
                <input type="text" name="telephone"
                       value="{{isset($user) ? $user->telephone : null}}"
                       class="form-control" id="formGroupExampleInput2" placeholder="Введите Телефон 79999999999">
                @error('telephone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Ваш пол:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio" name="gender"
                           value="{{isset($user) ? $user->gender : 1}}"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadio">Мужской</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio" name="gender"
                           value="{{isset($user) ? $user->gender : 0}}"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadio">Женский</label>
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Адресс</label>
                <input type="text" name="adress"
                       value="{{isset($user) ? $user->adress : null}}"
                       class="form-control" id="formGroupExampleInput2" placeholder="Введите Адресс">
                    </div>
                    </div>
            {{--<--create avto in table 1:m-->--}}

                @if(!isset($user))
                    <div class="col-sm">

                        <div class="form-group ">
                            <label for="formGroupExampleInput">Марка Авто</label>
                            <input type="text" name="marka"
                                   value="{{old('marka',isset($avto) ? $avto->marka : null)}}"
                                   class="form-control " id="formGroupExampleInput" placeholder="Введите Марку Авто">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Модель</label>
                            <input type="text" name="model"
                                   value="{{old('model',isset($avto) ? $avto->model : null)}}"
                                   class="form-control" id="formGroupExampleInput2" placeholder="Введите Модель авто">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Цвет автомобиля</label>
                            <input type="text" name="color"
                                   value="{{old('color',isset($avto) ? $avto->color : null)}}"
                                   class="form-control" id="formGroupExampleInput2" placeholder="Введите Цвет автомобиля">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Гос. номер машины</label>
                            <input type="text" name="gos_num"
                                   value="{{isset($avto) ? $avto->gos_num : null}}"
                                   class="form-control" id="formGroupExampleInput2" placeholder="Введите Гос. номер машины">
                            @error('gos_num')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                </div>
                @else
              @endif


            <div class="form-group m-2">
                <button class="btn btn-lg btn-secondary fw-bold border-white bg-dark" type="submit">{{isset($user) ? 'Сохранить'  : 'создать' }}</button>
                <a href="{{route('users.index')}}" class="btn btn-lg btn-secondary fw-bold border-white bg-dark">назад</a>
                </p>
            </div>



    </form>

    {{--  <form>
          <div class="col-md-4 mb-3">
              <div class="form-group">
                  <label for="formGroupExampleInput2">Адресс</label>
                  <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Введите Адресс">
              </div>

          </div>
      </form>--}}

@endsection
