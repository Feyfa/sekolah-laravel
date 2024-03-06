@extends('layouts.main')

@section('container')
    <main class="w-full h-screen flex flex-col justify-center items-center bg-green-100">
        
        @include('partials.alert-auth')

        <form action="/login" method="POST" class="w-[95%] sm:w-[80%] md:w-[65%] lg:w-[50%] xl:w-[35%] bg-[rgb(250,250,250)] p-5 border border-slate-300 rounded-md shadow-xl">
            @csrf
            <h1 class="text-center text-2xl sm:text-3xl font-semibold tracking-wide">Login SDN 03 Pagi</h1>
            
            <div class="username mt-5 @error('username') is-invalid @enderror">
                <label for="username" class="font-normal text-base sm:text-lg tracking-wide">Username</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="text" id="username" name="username" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-10 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br">
                        <i class="fa-regular fa-user fa-lg"></i>
                    </span>
                </div>
                @error('name')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="password mt-2.5 @error('password') is-invalid @enderror">
                <label for="password" class="font-normal text-base sm:text-lg tracking-wide">Password</label>
                <div class="input-password-container relative">
                    <input required autocomplete="off" type="password" id="password" name="password" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-11 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br cursor-pointer">
                        <i class="fa-regular fa-eye fa-lg"></i>
                    </span>
                </div>
                @error('password')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="regiter mt-2.5 text-end">
                <a href="/register" class="text-end underline text-blue-800 font-mediun">Register</a>
            </div>

            <div class="button mt-7">
                <button type="submit" class="py-2.5 sm:py-3 text-center border border-slate-400 w-full text-base sm:text-lg font-medium tracking-wide bg-blue-200 rounded hover:rounded-full">Login</button>
            </div>
        </form>
    </main>

    <script src="{{ asset('js/login/index.js') }}"></script>
@endsection