@extends('layout.admin', ['title' => 'Все категории каталога'])

@section('content')
    <h1>Все категории</h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-success mb-4">
        Создать категорию
    </a>
    <table class="table table-bordered">
        <tr>
            <!-- ..... -->
        </tr>
        @include('admin.category.part.tree', ['level' => -1, 'parent' => 0])
    </table>
@endsection
