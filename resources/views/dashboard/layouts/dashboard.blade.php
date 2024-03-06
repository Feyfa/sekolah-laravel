@extends('layouts.main')

@section('container')
<div class="max-w-full lg:flex lg:h-screen">
    <nav class="bg-slate-800 w-full fixed bottom-0 py-2 flex justify-around items-center lg:w-[7%] lg:static lg:flex-col lg:h-screen lg:justify-start xl:w-[6%] z-50">

        <a href="/" class="flex justify-center items-center w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 lg:w-[3.25rem] lg:h-[3.25rem] lg:my-3 lg:cursor-pointer lg:icon-hover lg:relative xl:w-14 xl:h-14 bg-slate-600 rounded-full {{ Request::is('/*') ? 'icon-active' : '' }}">
            <i class="fa-solid fa-user fa-xl text-green-500"></i>
            <p class="hidden bg-slate-800 text-white text-xl absolute w-max lg:translate-x-[110%] xl:translate-x-[120%] lg:z-50 py-2 px-6 rounded">
                <span class="bg-slate-800 w-6 h-6 top-0 -left-1 translate-y-[40%] rotate-45 absolute border-none"></span>
                User
            </p>
        </a>

        <a href="/list" class="flex justify-center items-center w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 lg:w-[3.25rem] lg:h-[3.25rem] lg:my-3 lg:cursor-pointer lg:icon-hover lg:relative xl:w-14 xl:h-14 bg-slate-600 rounded-full {{ Request::is('list*') ? 'icon-active' : '' }}">
            <i class="fa-solid fa-list fa-xl text-green-500"></i>
            <p class="hidden bg-slate-800 text-white text-xl absolute w-max lg:translate-x-[117%] xl:translate-x-[127%] lg:z-50 py-2 px-6 rounded">
                <span class="bg-slate-800 w-6 h-6 top-0 -left-1 translate-y-[40%] rotate-45 absolute border-none"></span>
                List
            </p>
        </a>

        <a href="/insert" class="flex justify-center items-center w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 lg:w-[3.25rem] lg:h-[3.25rem] lg:my-3 lg:cursor-pointer lg:icon-hover lg:relative xl:w-14 xl:h-14 bg-slate-600 rounded-full {{ Request::is('insert*') ? 'icon-active' : '' }}">
            <i class="fa-solid fa-plus fa-xl text-green-500"></i>
            <p class="hidden bg-slate-800 text-white text-xl absolute w-max lg:translate-x-[105%] xl:translate-x-[115%] lg:z-50 py-2 px-6 rounded">
                <span class="bg-slate-800 w-6 h-6 top-0 -left-1 translate-y-[40%] rotate-45 absolute border-none"></span>
                Insert
            </p>
        </a>

        <form action="/logout" method="POST" class="flex justify-center items-center w-10 h-10 sm:w-11 sm:h-11 md:w-12 md:h-12 lg:w-[3.25rem] lg:h-[3.25rem] lg:my-3 lg:cursor-pointer lg:icon-hover lg:absolute lg:bottom-0 xl:w-14 xl:h-14 bg-slate-600 rounded-full">
            @csrf
            <button type="submit" class="w-full h-full">
                <i class="fa-solid fa-arrow-right-from-bracket fa-xl text-green-500"></i>
            </button>
            <p class="hidden bg-slate-800 text-white text-xl absolute w-max lg:translate-x-[100%] xl:translate-x-[110%] lg:z-50 py-2 px-6 rounded">
                <span class="bg-slate-800 w-6 h-6 top-0 -left-1 translate-y-[40%] rotate-45 absolute border-none"></span>
                Logout
            </p>
        </form>

    </nav>

    @yield('dashboard-container')    
</div>
@endsection