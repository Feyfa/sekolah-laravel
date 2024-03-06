@extends('dashboard.layouts.dashboard')

@section('dashboard-container')

    <main class="verflow-hidden w-full p-3 mb-14 sm:mb-16 md:mb-[4.5rem] lg:w-[93%] lg:p-5 lg:h-screen lg:overflow-auto lg:relative xl:w-[94%] xl:p-7">

        @include('partials.alert')

        <div class="w-full">
            <div class="flex flex-col-reverse justify-center items-center gap-y-5 mb-5 sm:flex-row sm:justify-between sm:gap-y-0">
                <h1 class="text-xl font-semibold tracking-wide sm:text-2xl md:text-3xl sm:mb-2 md:mb-4 lg:mb-4 xl:mb-5">Murid Kelas {{ auth()->user()->kelas->name }}</h1>
                <input type="text" class="input-search border border-slate-500 py-2.5 px-2 rounded-sm text-lg outline-none w-full sm:w-1/3 lg:w-1/4" placeholder="Search">
            </div>

            {{ $murids->links() }}

            <table class="w-full border-collapse mx-auto text-base sm:text-lg mt-2">
                <thead class="text-left bg-slate-800 text-white">
                    <tr>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4">Foto</th>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4 hidden sm:table-cell">NIS/NISN</th>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4">Nama</th>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">Gender</th>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">Agama</th>
                        <th class="p-2 md:px-2 lg:px-3 xl:px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($murids as $murid)  
                        <tr class="border-b border-slate-300 text-left bg-white">
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4"><img width="80" class="sm:w-[85px] md:w-[90px] lg:w-[95px] xl:w-[100px]" src="{{ $murid->foto ? asset('storage/' . $murid->foto) :asset('img/user1/jidan.jpg') }}"></td>
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden sm:table-cell">{{ $murid->nis }}/{{ $murid->nisn }}</td>
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4">{{ $murid->name }}</td>
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">{{ $murid->gender->name }}</td>
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">{{ $murid->agama->name }}</td>
                            <td class="p-2 md:px-2 lg:px-3 xl:px-4 text-white font-medium">
                                <div class="flex justify-start items-center gap-x-5 sm:gap-x-6 md:gap-x-7 ld:gap-x-8">
                                    <a href="/list/edit/{{ $murid->nis }}?page={{ request()->query('page') }}" class="border border-gray-300 bg-gray-100 p-0.5 sm:p-1 rounded-sm"><i class="fa-solid fa-pencil fa-lg" style="color: #fac400;"></i></a>

                                    <form action="/list" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{ $murid->nis }}" name="nis">
                                        <button type="submit" class="border border-gray-300 bg-gray-100 p-0.5 sm:p-1 rounded-sm">
                                            <i class="fa-solid fa-trash fa-lg" style="color: #dc3545;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    
    <script src="{{ asset('js/dashboard/list/index.js') }}"></script>
@endsection
