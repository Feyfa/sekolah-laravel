@extends('dashboard.layouts.dashboard')


@section('dashboard-container')
    
    <form action="/insert" method="POST" enctype="multipart/form-data" class="overflow-hidden w-full p-3 mb-14 sm:mb-16 sm:p-4 md:mb-[4.5rem] md:p-5 lg:w-[93%] lg:p-6 xl:w-[94%] lg:h-screen lg:overflow-auto lg:relative">
        @csrf

        @include('partials.alert')

        <div class="hidden">
            <input type="hidden" value="murid-kelas-{{ auth()->user()->kelas_id }}" name="folder_image">
        </div>








        <div class="rows-container w-full overflow-hidden flex flex-col gap-10">
            @for ($i = 0; $i < $rows; $i++)
                <div class="rows rounded shadow-lg bg-neutral-50 p-3 border border-slate-500">
                    <div class="w-8 h-8 flex justify-center items-center font-semibold text-lg bg-slate-300 rounded ">{{ $i + 1 }}</div>

                    <div class="hidden">
                        <input type="hidden" value="{{ auth()->user()->username }}" name="murid[{{ $i }}][user]">
                    </div>

                    <div class="sm:text-center mt-2">
                        <img class="img block w-40 h-40 md:w-44 md:h-44 xl:w-48 xl:h-48 mx-auto bg-cover rounded-md ring-4 ring-slate-300">
                        <input type="file" name="murid[{{ $i }}][foto]" class="input-file text-base lg:text-lg mt-5 mb-5">
                        @error("murid.$i.foto")
                            <p class="text-red-600 font-normal text-lg mt-3">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <ul class="mt-1 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
                        <li class="@error("murid.$i.nis") is-invalid @enderror">
                            <label for="nis_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">NIS (wajib)</label>
                            <input required type="number" id="nis_{{ $i }}" name="murid[{{ $i }}][nis]" value="{{ old("murid.$i.nis") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                            @error("murid.$i.nis")
                                <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                            @enderror
                        </li>
                        <li class="@error("murid.$i.nisn") is-invalid @enderror">
                            <label for="nisn_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">NISN (wajib)</label>
                            <input required type="number" id="nisn_0" name="murid[{{ $i }}][nisn]" value="{{ old("murid.$i.nisn") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                            @error("murid.$i.nisn")
                                <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                            @enderror
                        </li>
                        <li class="@error("murid.$i.name") is-invalid @enderror">
                            <label for="name_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Nama (wajib)</label>
                            <input required type="text" id="name_{{ $i }}" name="murid[{{ $i }}][name]" value="{{ old("murid.$i.name") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                            @error("murid.$i.name")
                                <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                            @enderror
                        </li>
                        <li>
                            <label for="agama_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Agama (wajib)</label>
                            <select required name="murid[{{ $i }}][agama_id]" id="agama_{{ $i }}" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                                <option value="1" {{ old("murid.$i.agama_id") === 1 ? 'selected' : '' }}>Islam</option>
                                <option value="2" {{ old("murid.$i.agama_id") === 2 ? 'selected' : '' }}>Kristen</option>
                                <option value="3" {{ old("murid.$i.agama_id") === 3 ? 'selected' : '' }}>Budha</option>
                                <option value="4" {{ old("murid.$i.agama_id") === 4 ? 'selected' : '' }}>Hindu</option>
                                <option value="5" {{ old("murid.$i.agama_id") === 5 ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </li>
                    </ul>

                    <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                        <li>
                            <label for="gender_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Gender (wajib)</label>
                            <select required name="murid[{{ $i }}][gender_id]" id="gender_{{ $i }}" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                                <option value="1" {{ old("murid.$i.gender_id") === 1 ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="2" {{ old("murid.$i.gender_id") === 2 ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </li>
                        <li>
                            <label for="anak_ke_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Anak Ke</label>
                            <input type="number" min="1" step="1" id="anak_ke_{{ $i }}" value="{{ old("murid.$i.anak_ke") }}" name="murid[{{ $i }}][anak_ke]" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                        <li>
                            <label for="tempat_lahir_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir_{{ $i }}" name="murid[{{ $i }}][tempat_lahir]" value="{{ old("murid.$i.tempat_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                        <li>
                            <label for="tanggal_lahir_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir_{{ $i }}" name="murid[{{ $i }}][tanggal_lahir]" value="{{ old("murid.$i.tanggal_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                    </ul>

                    <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                        <li>
                            <label for="umur_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                            <input type="number" id="umur_{{ $i }}" name="murid[{{ $i }}][umur]" value="{{ old("murid.$i.umur") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                        <li>
                            <label for="tinggi_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (Cm)</label>
                            <input type="number" id="tinggi_{{ $i }}" name="murid[{{ $i }}][tinggi]" value="{{ old("murid.$i.tinggi") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                        <li>
                            <label for="berat_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">Berat (Kg)</label>
                            <input type="number" id="berat_{{ $i }}" name="murid[{{ $i }}][berat]" value="{{ old("murid.$i.berat") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                        <li>
                            <label for="nohp_{{ $i }}" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                            <input type="number" id="nohp_{{ $i }}" name="murid[{{ $i }}][nohp]" value="{{ old("murid.$i.nohp") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        </li>
                    </ul>

                    <ul class="mt-3 flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-x-5 lg:mt-4 xl:gap-x-10">
                        <li>
                            <label for="alamat_{{ $i }}" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                            <textarea name="murid[{{ $i }}][alamat]" id="alamat_{{ $i }}" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.$i.alamat") }}</textarea>
                        </li>
                        <li>
                            <label for="catatan_untuk_murid_{{ $i }}" class="block lg:text-lg font-medium tracking-wide">Catatan Untuk Murid</label>
                            <textarea name="murid[{{ $i }}][catatan_untuk_murid]" id="catatan_untuk_murid_{{ $i }}" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.$i.catatan_untuk_murid") }}</textarea>
                        </li>
                    </ul>
                </div>
            @endfor


            {{-- <div class="rows rounded shadow-lg bg-neutral-50 p-3 border border-slate-500">
                <div class="w-8 h-8 flex justify-center items-center font-semibold text-lg bg-slate-300 rounded ">1</div>

                <div class="hidden">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="murid[0][user_id]">
                </div>

                <div class="sm:text-center mt-2">
                    <span class="img block w-44 h-44 md:w-48 md:h-48 xl:w-52 xl:h-52 mx-auto bg-cover rounded-md ring-4 ring-slate-300"></span>
                    <input type="file" name="murid[0][foto]" class="input-file text-base lg:text-lg mt-5 mb-5">
                    @error('murid.0.foto')
                        <p class="text-red-600 font-normal text-lg mt-3">{{ $message }}</p>
                    @enderror
                </div>
                
                <ul class="mt-1 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
                    <li class="@error('murid.0.nisn') is-invalid @enderror">
                        <label for="nisn_0" class="block text-base lg:text-lg font-medium tracking-wide">NISN (wajib)</label>
                        <input required type="number" id="nisn_0" name="murid[0][nisn]" value="{{ old("murid.0.nisn") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.0.nisn')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.0.nis') is-invalid @enderror">
                        <label for="nis_0" class="block text-base lg:text-lg font-medium tracking-wide">NIS (wajib)</label>
                        <input required type="number" id="nis_0" name="murid[0][nis]" value="{{ old("murid.0.nis") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.0.nis')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.0.name') is-invalid @enderror">
                        <label for="name_0" class="block text-base lg:text-lg font-medium tracking-wide">Nama (wajib)</label>
                        <input required type="text" id="name_0" name="murid[0][name]" value="{{ old("murid.0.name") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.0.name')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li>
                        <label for="agama_0" class="block text-base lg:text-lg font-medium tracking-wide">Agama (wajib)</label>
                        <select required name="murid[0][agama_id]" id="agama_0" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.0.agama_id") === 1 ? 'selected' : '' }}>Islam</option>
                            <option value="2" {{ old("murid.0.agama_id") === 2 ? 'selected' : '' }}>Kristen</option>
                            <option value="3" {{ old("murid.0.agama_id") === 3 ? 'selected' : '' }}>Budha</option>
                            <option value="4" {{ old("murid.0.agama_id") === 4 ? 'selected' : '' }}>Hindu</option>
                            <option value="5" {{ old("murid.0.agama_id") === 5 ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="gender_0" class="block text-base lg:text-lg font-medium tracking-wide">Gender (wajib)</label>
                        <select required name="murid[0][gender_id]" id="gender_0" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.0.gender_id") === 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ old("murid.0.gender_id") === 2 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </li>
                    <li>
                        <label for="anak_ke_0" class="block text-base lg:text-lg font-medium tracking-wide">Anak Ke</label>
                        <input type="number" min="1" step="1" id="anak_ke_0" value="{{ old("murid.0.anak_ke") }}" name="murid[0][anak_ke]" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tempat_lahir_0" class="block text-base lg:text-lg font-medium tracking-wide">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir_0" name="murid[0][tempat_lahir]" value="{{ old("murid.0.tempat_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tanggal_lahir_0" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_0" name="murid[0][tanggal_lahir]" value="{{ old("murid.0.tanggal_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="umur_0" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                        <input type="number" id="umur_0" name="murid[0][umur]" value="{{ old("murid.0.umur") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tinggi_0" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (Cm)</label>
                        <input type="number" id="tinggi_0" name="murid[0][tinggi]" value="{{ old("murid.0.tinggi") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="berat_0" class="block text-base lg:text-lg font-medium tracking-wide">Berat (Kg)</label>
                        <input type="number" id="berat_0" name="murid[0][berat]" value="{{ old("murid.0.berat") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="nohp_0" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                        <input type="number" id="nohp_0" name="murid[0][nohp]" value="{{ old("murid.0.nohp") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-x-5 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="alamat_0" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                        <textarea name="murid[0][alamat]" id="alamat_0" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.0.alamat") }}</textarea>
                    </li>
                    <li>
                        <label for="catatan_untuk_murid_0" class="block lg:text-lg font-medium tracking-wide">Catatan Untuk Murid</label>
                        <textarea name="murid[0][catatan_untuk_murid]" id="catatan_untuk_murid_0" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.0.catatan_untuk_murid") }}</textarea>
                    </li>
                </ul>
            </div> --}}






            {{-- <div class="rows rounded shadow-lg bg-neutral-50 p-3 border border-slate-500">
                <div class="w-8 h-8 flex justify-center items-center font-semibold text-lg bg-slate-300 rounded ">2</div>

                <div class="hidden">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="murid[1][user_id]">
                </div>

                <div class="sm:text-center mt-2">
                    <span class="img block w-44 h-44 md:w-48 md:h-48 xl:w-52 xl:h-52 mx-auto bg-cover rounded-md ring-4 ring-slate-300"></span>
                    <input type="file" name="murid[1][foto]" class="input-file text-base lg:text-lg mt-5 mb-5">
                    @error('murid.1.foto')
                        <p class="text-red-600 font-normal text-lg mt-3">{{ $message }}</p>
                    @enderror
                </div>
                
                <ul class="mt-1 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
                    <li class="@error('murid.1.nisn') is-invalid @enderror">
                        <label for="nisn_1" class="block text-base lg:text-lg font-medium tracking-wide">NISN (wajib)</label>
                        <input required type="number" id="nisn_1" name="murid[1][nisn]" value="{{ old("murid.1.nisn") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.1.nisn')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.1.nis') is-invalid @enderror">
                        <label for="nis_1" class="block text-base lg:text-lg font-medium tracking-wide">NIS (wajib)</label>
                        <input required type="number" id="nis_1" name="murid[1][nis]" value="{{ old("murid.1.nis") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.1.nis')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.1.name') is-invalid @enderror">
                        <label for="name_1" class="block text-base lg:text-lg font-medium tracking-wide">Nama (wajib)</label>
                        <input required type="text" id="name_1" name="murid[1][name]" value="{{ old("murid.1.name") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.1.name')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li>
                        <label for="agama_1" class="block text-base lg:text-lg font-medium tracking-wide">Agama (wajib)</label>
                        <select required name="murid[1][agama_id]" id="agama_1" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.1.agama_id") === 1 ? 'selected' : '' }}>Islam</option>
                            <option value="2" {{ old("murid.1.agama_id") === 2 ? 'selected' : '' }}>Kristen</option>
                            <option value="3" {{ old("murid.1.agama_id") === 3 ? 'selected' : '' }}>Budha</option>
                            <option value="4" {{ old("murid.1.agama_id") === 4 ? 'selected' : '' }}>Hindu</option>
                            <option value="5" {{ old("murid.1.agama_id") === 5 ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="gender_1" class="block text-base lg:text-lg font-medium tracking-wide">Gender (wajib)</label>
                        <select required name="murid[1][gender_id]" id="gender_1" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.1.gender_id") === 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ old("murid.1.gender_id") === 2 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </li>
                    <li>
                        <label for="anak_ke_1" class="block text-base lg:text-lg font-medium tracking-wide">Anak Ke</label>
                        <input type="number" min="1" step="1" id="anak_ke_1" value="{{ old("murid.1.anak_ke") }}" name="murid[1][anak_ke]" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tempat_lahir_1" class="block text-base lg:text-lg font-medium tracking-wide">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir_1" name="murid[1][tempat_lahir]" value="{{ old("murid.1.tempat_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tanggal_lahir_1" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_1" name="murid[1][tanggal_lahir]" value="{{ old("murid.1.tanggal_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="umur_1" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                        <input type="number" id="umur_1" name="murid[1][umur]" value="{{ old("murid.1.umur") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tinggi_1" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (Cm)</label>
                        <input type="number" id="tinggi_1" name="murid[1][tinggi]" value="{{ old("murid.1.tinggi") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="berat_1" class="block text-base lg:text-lg font-medium tracking-wide">Berat (Kg)</label>
                        <input type="number" id="berat_1" name="murid[1][berat]" value="{{ old("murid.1.berat") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="nohp_1" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                        <input type="number" id="nohp_1" name="murid[1][nohp]" value="{{ old("murid.1.nohp") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-x-5 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="alamat_1" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                        <textarea name="murid[1][alamat]" id="alamat_1" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.1.alamat") }}</textarea>
                    </li>
                    <li>
                        <label for="catatan_untuk_murid_1" class="block lg:text-lg font-medium tracking-wide">Catatan Untuk Murid</label>
                        <textarea name="murid[1][catatan_untuk_murid]" id="catatan_untuk_murid_1" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.1.catatan_untuk_murid") }}</textarea>
                    </li>
                </ul>
            </div>






            <div class="rows rounded shadow-lg bg-neutral-50 p-3 border border-slate-500">
                <div class="w-8 h-8 flex justify-center items-center font-semibold text-lg bg-slate-300 rounded ">3</div>

                <div class="hidden">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="murid[2][user_id]">
                </div>

                <div class="sm:text-center mt-2">
                    <span class="img block w-44 h-44 md:w-48 md:h-48 xl:w-52 xl:h-52 mx-auto bg-cover rounded-md ring-4 ring-slate-300"></span>
                    <input type="file" name="murid[2][foto]" class="input-file text-base lg:text-lg mt-5 mb-5">
                    @error('murid.2.foto')
                        <p class="text-red-600 font-normal text-lg mt-3">{{ $message }}</p>
                    @enderror
                </div>
                
                <ul class="mt-1 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
                    <li class="@error('murid.2.nisn') is-invalid @enderror">
                        <label for="nisn_2" class="block text-base lg:text-lg font-medium tracking-wide">NISN (wajib)</label>
                        <input required type="number" id="nisn_2" name="murid[2][nisn]" value="{{ old("murid.2.nisn") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.2.nisn')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.2.nis') is-invalid @enderror">
                        <label for="nis_2" class="block text-base lg:text-lg font-medium tracking-wide">NIS (wajib)</label>
                        <input required type="number" id="nis_2" name="murid[2][nis]" value="{{ old("murid.2.nis") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.2.nis')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li class="@error('murid.2.name') is-invalid @enderror">
                        <label for="name_2" class="block text-base lg:text-lg font-medium tracking-wide">Nama (wajib)</label>
                        <input required type="text" id="name_2" name="murid[2][name]" value="{{ old("murid.2.name") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                        @error('murid.2.name')
                            <p class="text-red-600 font-normal text-sm lg:text-base">{{ $message }}</p>
                        @enderror
                    </li>
                    <li>
                        <label for="agama_2" class="block text-base lg:text-lg font-medium tracking-wide">Agama (wajib)</label>
                        <select required name="murid[2][agama_id]" id="agama_2" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.0.agama_id") === 1 ? 'selected' : '' }}>Islam</option>
                            <option value="2" {{ old("murid.0.agama_id") === 2 ? 'selected' : '' }}>Kristen</option>
                            <option value="3" {{ old("murid.0.agama_id") === 3 ? 'selected' : '' }}>Budha</option>
                            <option value="4" {{ old("murid.0.agama_id") === 4 ? 'selected' : '' }}>Hindu</option>
                            <option value="5" {{ old("murid.0.agama_id") === 5 ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="gender_2" class="block text-base lg:text-lg font-medium tracking-wide">Gender (wajib)</label>
                        <select required name="murid[2][gender_id]" id="gender_2" class="border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-[.55rem] xl:p-2.5 rounded-sm shadow font-normal">
                            <option value="1" {{ old("murid.0.gender_id") === 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ old("murid.0.gender_id") === 2 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </li>
                    <li>
                        <label for="anak_ke_2" class="block text-base lg:text-lg font-medium tracking-wide">Anak Ke</label>
                        <input type="number" min="1" step="1" id="anak_ke_2" value="{{ old("murid.0.anak_ke") }}" name="murid[2][anak_ke]" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tempat_lahir_2" class="block text-base lg:text-lg font-medium tracking-wide">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir_2" name="murid[2][tempat_lahir]" value="{{ old("murid.0.tempat_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tanggal_lahir_2" class="block text-base lg:text-lg font-medium tracking-wide">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_2" name="murid[2][tanggal_lahir]" value="{{ old("murid.0.tanggal_lahir") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="umur_2" class="block text-base lg:text-lg font-medium tracking-wide">Umur (Tahun)</label>
                        <input type="number" id="umur_2" name="murid[2][umur]" value="{{ old("murid.0.umur") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="tinggi_2" class="block text-base lg:text-lg font-medium tracking-wide">Tinggi (Cm)</label>
                        <input type="number" id="tinggi_2" name="murid[2][tinggi]" value="{{ old("murid.0.tinggi") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="berat_2" class="block text-base lg:text-lg font-medium tracking-wide">Berat (Kg)</label>
                        <input type="number" id="berat_2" name="murid[2][berat]" value="{{ old("murid.0.berat") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                    <li>
                        <label for="nohp_2" class="block text-base lg:text-lg font-medium tracking-wide">NoHp</label>
                        <input type="number" id="nohp_2" name="murid[2][nohp]" value="{{ old("murid.0.nohp") }}" class="input border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
                    </li>
                </ul>
        
                <ul class="mt-3 flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-x-5 lg:mt-4 xl:gap-x-10">
                    <li>
                        <label for="alamat_2" class="block lg:text-lg font-medium tracking-wide">Alamat</label>
                        <textarea name="murid[2][alamat]" id="alamat_2" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.0.alamat") }}</textarea>
                    </li>
                    <li>
                        <label for="catatan_untuk_murid_2" class="block lg:text-lg font-medium tracking-wide">Catatan Untuk Murid</label>
                        <textarea name="murid[2][catatan_untuk_murid]" id="catatan_untuk_murid_2" rows="4" class="border border-gray-500 w-full lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">{{ old("murid.0.catatan_untuk_murid") }}</textarea>
                    </li>
                </ul>
            </div> --}}
        </div>


















        
        <ul class="flex gap-5 p-3 items-end sm:grid sm:grid-cols-2 sm:gap-x-5 lg:grid lg:grid-cols-4 lg:mt-2 xl:gap-x-10">
            <li class="w-full">
                <label for="rows" class="block text-base font-medium tracking-wide">Rows <span class="text-xs font-semibold">max(3)</span></label>
                <input type="number" min="1" max="3" step="1" value="{{ $rows }}" id="rows" class="input-rows border border-gray-500 w-full text-base lg:text-lg outline-none py-2.5 px-2 lg:p-1.5 xl:p-2 rounded-sm shadow font-normal">
            </li>
            <li class="w-full">
                <button type="submit" class="py-2.5 sm:py-1.5 lg:p-1.5 xl:p-2 text-center border border-slate-400 w-full text-base sm:text-lg font-medium tracking-widest bg-green-400 text-[#22] rounded hover:rounded-full">insert</button>
            </li>
        </ul>
    </form>

    <script src="{{ asset('js/dashboard/insert/index.js') }}"></script>
@endsection