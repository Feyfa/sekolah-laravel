@extends('layouts.main')

@section('container')
    <main class="w-full h-screen flex justify-center items-start py-5 bg-green-100 overflow-auto">
        <form action="/register" method="POST" class="w-[95%] sm:w-[80%] md:w-[65%] lg:w-[50%] xl:w-[35%] bg-[rgb(250,250,250)] p-5 border border-slate-300 rounded-md shadow-xl">
            @csrf
            <h1 class="text-center text-2xl sm:text-3xl font-semibold tracking-wide">Register SDN 03 Pagi</h1>
            
            <div class="username mt-5 @error('name') is-invalid @enderror">
                <label for="name" class="font-normal text-base sm:text-lg tracking-wide">Name</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="text" id="name" name="name" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-10 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br">
                        <i class="fa-regular fa-user fa-lg"></i>
                    </span>
                </div>
                @error('name')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- jika ingin membuat akun admin, ini di aktifkan --}}
            {{-- <div class="jabatan mt-2.5 @error('jabatan') is-invalid @enderror is-valid">
                <label for="jabatan" class="font-normal text-base sm:text-lg tracking-wide">Jabatan</label>
                <div class="input-jabatan-container relative">
                    <select name="jabatan" id="jabatan" class="text-base sm:text-lg w-full py-1.5 sm:py-1.5 pl-2 pr-10 border border-slate-500 outline-none rounded">
                        <option value="Admin">Admin</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                    </select>
                </div>
                @error('jabatan')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div> --}}
            {{-- jika ingin membuat akun admin, ini di aktifkan --}}

            {{-- jika ingin membuat akun admin, ini di nonaktifkan --}}
            <div class="kelas_id mt-2.5 @error('kelas_id') is-invalid @enderror is-valid">
                <label for="kelas_id" class="font-normal text-base sm:text-lg tracking-wide">Pengajar Kelas</label>
                <div class="input-kelas_id-container relative">
                    <select name="kelas_id" id="kelas_id" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-2 pr-10 border border-slate-500 outline-none rounded">
                        <option value="1">Satu</option>
                        <option value="2">Dua</option>
                        <option value="3">Tiga</option>
                        <option value="4">Empat</option>
                        <option value="5">Lima</option>
                        <option value="6">Enam</option>
                    </select>
                </div>
                @error('kelas_id')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>
            {{-- jika ingin membuat akun admin, ini di nonaktifkan --}}
            
            <div class="username mt-2.5 @error('username') is-invalid @enderror">
                <label for="username" class="font-normal text-base sm:text-lg tracking-wide">Username</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="text" id="username" name="username" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-10 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br">
                        <i class="fa-regular fa-user fa-lg"></i>
                    </span>
                </div>
                @error('username')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="password mt-2.5 @error('password') is-invalid @enderror">
                <label for="password" class="font-normal text-base sm:text-lg tracking-wide">Password</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="password" id="password" name="password" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-11 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br cursor-pointer">
                        <i class="fa-regular fa-eye fa-lg"></i>
                    </span>
                </div>
                @error('password')
                    <p class="text-red-600 font-normal text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- jika ingin membuat akun admin, ini di nonaktifkan --}}
            <h2 class="mt-5 font-semibold underline">!!! Harus Ada Persetujuan Admin</h2>

            <div class="username mt-3.5 {{ session()->has('admin-invalid') ? 'is-invalid' : '' }}">
                <label for="usernameAdmin" class="font-normal text-base sm:text-lg tracking-wide">Username Admin</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="text" id="usernameAdmin" name="usernameAdmin" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-10 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br">
                        <i class="fa-regular fa-user fa-lg"></i>
                    </span>
                </div>
                @if(session()->has('admin-invalid'))
                    <p class="text-red-600 font-normal text-sm">{{ session('admin-invalid') }}</p>
                @endif
            </div>

            <div class="password mt-2.5 {{ session()->has('admin-invalid') ? 'is-invalid' : '' }}">
                <label for="passwordAdmin" class="font-normal text-base sm:text-lg tracking-wide">Password Admin</label>
                <div class="input-username-container relative">
                    <input required autocomplete="off" type="password" id="passwordAdmin" name="passwordAdmin" class="text-base sm:text-lg w-full py-2.5 sm:py-3 pl-3 pr-11 border border-slate-500 outline-none rounded">
                    <span class="absolute right-0 top-0 bottom-0 flex justify-center items-center pr-2 m-[1px] rounded-tr rounded-br cursor-pointer">
                        <i class="fa-regular fa-eye fa-lg"></i>
                    </span>
                </div>
                @if(session()->has('admin-invalid'))
                    <p class="text-red-600 font-normal text-sm">{{ session('admin-invalid') }}</p>
                @endif
            </div>
            {{-- jika ingin membuat akun admin, ini di nonaktifkan --}}

            <div class="regiter mt-2.5 text-end">
                <a href="/login" class="text-end underline text-blue-800 font-mediun">Login</a>
            </div>

            <div class="button mt-2.5">
                <button type="submit" class="py-2.5 sm:py-3 text-center border border-slate-400 w-full text-base sm:text-lg font-medium tracking-wide bg-blue-200 rounded hover:rounded-full">Register</button>
            </div>
        </form>
    </main>

    <script src="{{ asset('js/register/index.js') }}"></script>

@endsection