@extends('dashboard.layouts.dashboard')

@section('dashboard-container')
    
    <form action="/user/update" method="POST" enctype="multipart/form-data" class="overflow-hidden w-full p-3 mb-14 sm:mb-16 md:mb-[4.5rem] lg:w-[93%] lg:px-10 lg:py-5 xl:w-[94%] lg:h-screen lg:overflow-auto lg:relative">
        @csrf

        @include('partials.alert')

        <div class="hidden">
            <input type="hidden" value="{{ auth()->user()->username }}" name="username">
        </div>

        <div class="sm:text-center">
            <img src="{{ asset("storage/" . auth()->user()->foto) }}" class="img block w-40 h-40 md:w-44 md:h-44 xl:w-48 xl:h-48 mx-auto bg-cover rounded-md ring-4 ring-slate-300">
            <input type="hidden" name="oldFoto" value="{{ auth()->user()->foto }}" class="old-input">
            <input type="file" name="foto" class="input-file text-base lg:text-lg hidden mt-5 mb-5">
            @error('foto')
                <p class="text-red-600 font-normal text-lg mt-3">{{ $message }}</p>
            @enderror
        </div>

        <div class="icon-container flex justify-end mt-1">
            <p class="font-semibold text-green-500 hidden edit-mode lg:text-lg">Edit Mode</p>
            <span class="pencil cursor-pointer"><i class="fa-solid fa-pencil fa-xl mr-1" style="color: #fac400;"></i></span>
            <span class="xmark hidden cursor-pointer"><i class="fa-solid fa-circle-xmark fa-xl mr-1" style="color: #ff0000;"></i></span>
        </div>

        <ul class="mt-1 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
            <li class="@error('name') is-invalid @enderror">
                <label for="name" class="block text-base lg:text-lg font-medium tracking-wide">Name</label>
                <input required readonly type="text" value="{{ auth()->user()->name }}" id="name" name="name" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                @error('name')
                    <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                @enderror
            </li>
            <li>
                <label for="jenis_kelamin" class="block text-base lg:text-lg font-medium tracking-wide">Jenis Kelamin</label>
                <select disabled name="jenis_kelamin" id="jenis_kelamin" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                    <option value="" hidden {{ auth()->user()->jenis_kelamin === null ? 'selected' : '' }}></option>
                    <option value="Laki-Laki" {{ auth()->user()->jenis_kelamin === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ auth()->user()->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </li>
            <li>
                <label for="tanggal_lahir" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                <input readonly type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.35rem] xl:p-[.4rem] rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="jabatan" class="block text-base lg:text-lg font-medium tracking-wide">Jabatan</label>
                <input readonly type="text" id="jabatan" name="jabatan" value="Guru Kelas {{ auth()->user()->kelas->name }}" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.35rem] xl:p-[.4rem] rounded-sm shadow font-normal bg-gray-300">
            </li>
        </ul>

        <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
            <li>
                <label for="umur" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                <input readonly type="number" min="1" step="1" value="{{ auth()->user()->umur }}" id="umur" name="umur" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="tinggi" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (cm)</label>
                <input readonly type="number" min="1" step="1" value="{{ auth()->user()->tinggi }}" id="tinggi" name="tinggi" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="berat" class="block text-base lg:text-lg font-medium tracking-wide">Berat (kg)</label>
                <input readonly type="number" min="1" step="1" value="{{ auth()->user()->berat }}" id="berat" name="berat" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="nohp" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                <input readonly type="number" value="{{ auth()->user()->nohp }}" id="nohp" name="nohp" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
        </ul>

        <ul class="mt-3 flex flex-col gap-2 lg:grid lg:grid-cols-2 lg:gap-x-5 lg:mt-4 xl:gap-x-10">
            <li>
                <label for="pendidikan" class="block lg:text-lg font-medium tracking-wide">Pendidikan</label>
                <textarea readonly name="pendidikan" id="pendidikan" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ auth()->user()->pendidikan }}</textarea>
            </li>
            <li>
                <label for="hobi" class="block lg:text-lg font-medium tracking-wide">Hobi</label>
                <textarea readonly name="hobi" id="hobi" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ auth()->user()->hobi }}</textarea>
            </li>
            <li>
                <label for="alamat" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                <textarea readonly name="alamat" id="alamat" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ auth()->user()->alamat }}</textarea>
            </li>
            <li>
                <label for="motivasi" class="block lg:text-lg font-medium tracking-wide">Motivasi</label>
                <textarea readonly name="motivasi" id="motivasi" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ auth()->user()->motivasi }}</textarea>
            </li>
        </ul>

        <div class="btn-edit button mt-3 hidden lg:mt-8">
            <button type="submit" class="py-2.5 sm:py-1.5 text-center border border-slate-400 w-full text-base sm:text-lg font-medium tracking-widest bg-green-400 text-[#22] rounded hover:rounded-full">Edit</button>
        </div>
    </form>
    
    <script src="{{ asset('js/dashboard/user/index.js') }}"></script>
@endsection
