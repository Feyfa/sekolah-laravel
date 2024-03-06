
@if (count($murids) > 0)
    @foreach ($murids as $murid)  
    <tr class="border-b border-slate-300 text-left bg-white">
        <td class="p-2 md:px-2 lg:px-3 xl:px-4"><img width="80" class="sm:w-[85px] md:w-[90px] lg:w-[95px] xl:w-[100px]" src="{{ $murid->foto ? asset('storage/' . $murid->foto) :asset('img/user1/jidan.jpg') }}"></td>
        <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden sm:table-cell">{{ $murid->nis }}/{{ $murid->nisn }}</td>
        <td class="p-2 md:px-2 lg:px-3 xl:px-4">{{ $murid->name }}</td>
        <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">{{ $murid->gender->name }}</td>
        <td class="p-2 md:px-2 lg:px-3 xl:px-4 hidden lg:table-cell">{{ $murid->agama->name }}</td>
        <td class="p-2 md:px-2 lg:px-3 xl:px-4 text-white font-medium">
            <div class="flex justify-start items-center gap-x-5 sm:gap-x-6 md:gap-x-7 ld:gap-x-8">
                <a href="/list/edit/{{ $murid->nis }}" class="border border-gray-300 bg-gray-100 p-0.5 sm:p-1 rounded-sm"><i class="fa-solid fa-pencil fa-lg" style="color: #fac400;"></i></a>

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
@else
    <h1 class="text-lg font-medium mt-2 lg:text-xl">Murid Tidak Ditemukan</h1>
@endif