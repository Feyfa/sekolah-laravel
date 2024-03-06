@if(session()->has('flash'))    
    <div class="alert alert-{{ session('flash')['status'] }} flex justify-between bg-slate-100 px-10 py-2.5 fixed top-0 left-0 right-0 border border-slate-500 shadow lg:absolute">
        <h1 class="text-lg font-medium text-white tracking-wide">{{ session('flash')['message'] }}</h1>
        <span class="bg-slate-100 cursor-pointer bg-transparent"><i class="fa-solid fa-xmark fa-lg text-white"></i></span>
    </div>
    <script src="{{ asset('js/alert/index.js') }}"></script>
@endif
