@extends('dashboard.layouts.dashboard')

@section('dashboard-container')
    
    <form action="/list" method="POST" enctype="multipart/form-data" class="overflow-hidden w-full p-3 mb-14 sm:mb-16 md:mb-[4.5rem] lg:w-[93%] lg:px-10 lg:py-5 xl:w-[94%] lg:h-screen lg:overflow-auto lg:relative">
        @csrf
        @method('PUT')

        @include('partials.alert')

        
        <a href="/list" class="border border-slate-400 rounded-sm py-1.5 px-2 bg-green-400 font-bold"><---</a>

        <div class="hidden">
            <input type="hidden" name="old_nis" value="{{ $murid->nis }}">
            <input type="hidden" name="page" value="{{ $page }}">
            <input type="hidden" value="murid-kelas-{{ auth()->user()->kelas_id }}" name="folder_image">
        </div>

        <div class="sm:text-center">
            <img src="{{ asset("storage/" . $murid->foto) }}" class="img block w-40 h-40 md:w-44 md:h-44 xl:w-48 xl:h-48 mx-auto bg-cover rounded-md ring-4 ring-slate-300">
            <input type="hidden" name="oldFoto" value="{{ $murid->foto }}" class="old-input">
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
            <li class="@error('nis') is-invalid @enderror">
                <label for="nis" class="block text-base lg:text-lg font-medium tracking-wide">NIS (Wajib)</label>
                <input required readonly type="text" value="{{ $murid->nis }}" id="nis" name="nis" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                @error('nis')
                    <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                @enderror
            </li>
            <li class="@error('nisn') is-invalid @enderror">
                <label for="nisn" class="block text-base lg:text-lg font-medium tracking-wide">NISN (Wajib)</label>
                <input required readonly type="text" value="{{ $murid->nisn }}" id="nisn" name="nisn" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                @error('nisn')
                    <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                @enderror
            </li>
            <li class="@error('name') is-invalid @enderror">
                <label for="name" class="block text-base lg:text-lg font-medium tracking-wide">Nama (Wajib)</label>
                <input required readonly type="text" value="{{ $murid->name }}" id="name" name="name" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                @error('name')
                    <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                @enderror
            </li>
            <li>
                <label for="agama_id" class="block text-base lg:text-lg font-medium tracking-wide">Agama (Wajib)</label>
                <select required disabled name="agama_id" id="agama_id" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                    <option value="1" {{ $murid->agama->name === 'Islam' ? 'selected' : ''}}>Islam</option>
                    <option value="2" {{ $murid->agama->name === 'Kristen' ? 'selected' : ''}}>Kristen</option>
                    <option value="3" {{ $murid->agama->name === 'Budha' ? 'selected' : ''}}>Budha</option>
                    <option value="4" {{ $murid->agama->name === 'Hindu' ? 'selected' : ''}}>Hindu</option>
                    <option value="5" {{ $murid->agama->name === 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                </select>
            </li>
        </ul>

        <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
            <li>
                <label for="gender_id" class="block text-base lg:text-lg font-medium tracking-wide">Gender (Wajib)</label>
                <select disabled name="gender_id" id="gender_id" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                    <option value="1" {{ $murid->gender->name === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="2" {{ $murid->gender->name === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </li>
            <li>
                <label for="anak_ke" class="block text-base lg:text-lg font-medium tracking-wide">Anak Ke</label>
                <input readonly type="number" min="1" step="1" value="{{ $murid->anak_ke }}" id="anak_ke" name="anak_ke" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="tempat_lahir" class="block text-base lg:text-lg font-medium tracking-wide">Tempat Lahir</label>
                <input readonly type="text" value="{{ $murid->tempat_lahir }}" id="tempat_lahir" name="tempat_lahir" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="tanggal_lahir" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                <input readonly type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $murid->tanggal_lahir }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.35rem] xl:p-[.4rem] rounded-sm shadow font-normal">
            </li>
        </ul>

        <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
            <li>
                <label for="umur" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                <input readonly type="number" id="umur" name="umur" value="{{ $murid->umur }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="tinggi" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (Cm)</label>
                <input readonly type="number" id="tinggi" name="tinggi" value="{{ $murid->tinggi }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="berat" class="block text-base lg:text-lg font-medium tracking-wide">Berat (Kg)</label>
                <input readonly type="number" id="berat" name="berat" value="{{ $murid->berat }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li>
                <label for="nohp" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                <input readonly type="number" id="nohp" name="nohp" value="{{ $murid->nohp }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
        </ul>

        <ul class="mt-3 flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-x-5 lg:mt-4 xl:gap-x-10">
            <li>
                <label for="alamat" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                <textarea readonly name="alamat" id="alamat" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ $murid->alamat }}</textarea>
            </li>
            <li>
                <label for="catatan_untuk_murid" class="block lg:text-lg font-medium tracking-wide">Catatan Untuk Murid</label>
                <textarea readonly name="catatan_untuk_murid" id="catatan_untuk_murid" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ $murid->catatan_untuk_murid }}</textarea>
            </li>
        </ul>

        <div class="btn-edit button mt-3 hidden lg:mt-8">
            <button type="submit" class="py-2.5 sm:py-1.5 text-center border border-slate-400 w-full text-base sm:text-lg font-medium tracking-widest bg-green-400 text-[#22] rounded hover:rounded-full">Edit</button>
        </div>
    </form>
    
    <script src="{{ asset('js/dashboard/edit/index.js') }}"></script>
@endsection
