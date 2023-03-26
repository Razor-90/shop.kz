@extends('layout.site', ['title' => 'Личный кабинет'])

@section('content')
    <h1>Личный кабинет</h1>
    <p>Добро пожаловать, {{ auth()->user()->name }}!</p>
    <p>Это личный кабинет постоянного покупателя нашего интернет-магазина.</p>
    <ul>
        <li><a href="{{ route('user.profile.index') }}">Ваши профили</a></li>
        <li><a href="{{ route('user.order.index') }}">Ваши заказы</a></li>
        @if(auth()->user()->admin == 1)
            <li><a href="{{ route('admin.category.index') }}">Все категории</a></li>
            <li><a href="{{ route('admin.brand.index') }}">Все бренды каталога</a></li>
            <li><a href="{{ route('admin.product.index') }}">Все товары</a></li>
            <li><a href="{{ route('admin.order.index') }}">Все заказы</a></li>
            <li><a href="{{ route('admin.page.index') }}">Все страницы сайта</a></li>
            <li><a href="{{ route('admin.user.index') }}">Все пользователи</a></li>
@endif
            </ul>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Выйти</button>
    </form>
@endsection
