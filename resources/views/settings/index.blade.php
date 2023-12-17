@extends('layouts.admin')
@section('content')
    <h1>Настройки</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Значение</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($settings as $setting)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$setting->getKey()}}</td>
                <td>{{$setting->getValuePrice()}}</td>
                <td>
{{--                    <a href="{{route('admin.bonds.edit', $bond)}}"><i class="fa-solid fa-pen"></i></a>--}}
{{--                    <form action="{{ route('admin.bonds.destroy', $bond) }}" method="POST" class="d-inline">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}

{{--                        <button class="btn btn-danger"--}}
{{--                                onclick="return confirm('Вы уверены, что хотите удалить?');"--}}
{{--                                data-toggle="tooltip" data-placement="top" title="Удалить">--}}
{{--                            <i class="fa-solid fa-trash"></i>--}}
{{--                        </button>--}}
{{--                    </form>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
