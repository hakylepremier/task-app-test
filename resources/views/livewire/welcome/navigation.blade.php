<div class="fixed top-0 right-0 z-20 flex flex-col gap-2 items-end p-4 px-4 sm:p-6 text-end sm:block sm:space-x-2">
  @auth
    <a href="{{ url('/tasks') }}"
      class="font-semibold text-gray-600 hover:text-gray-900 relative top-0 left-0 active:top-1 active:left-1 transition-all ease-in focus:outline focus:outline-2 focus:rounded-3xl focus:outline-teal-400 bg-gray-200 px-8 py-2 hover:bg-white active:shadow-[6px_6px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)] hover:shadow-[10px_10px_1px_rgba(23,_169,_148,_1),_0_10px_20px_rgba(204,_204,_204,_1)] rounded-3xl shadow-[10px_10px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)]"
      wire:navigate>Tasks</a>
  @else
    <a href="{{ route('login') }}"
      class="font-semibold text-gray-600 hover:text-gray-900 relative top-0 left-0 active:top-1 active:left-1 transition-all ease-in focus:outline focus:outline-2 focus:rounded-3xl focus:outline-teal-400 bg-gray-200 px-8 py-2 hover:bg-white active:shadow-[6px_6px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)] hover:shadow-[10px_10px_1px_rgba(23,_169,_148,_1),_0_10px_20px_rgba(204,_204,_204,_1)] rounded-3xl shadow-[10px_10px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)]"
      wire:navigate>Log in</a>
    {{-- // HACK: removes register link from production --}}
    @if (Route::has('register'))
      <a href="{{ route('register') }}"
        class="font-semibold text-gray-600 hover:text-gray-900 relative top-0 left-0 active:top-1 active:left-1 transition-all ease-in focus:outline focus:outline-2 focus:rounded-3xl focus:outline-teal-400 bg-gray-200 px-8 py-2 hover:bg-white active:shadow-[6px_6px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)] hover:shadow-[10px_10px_1px_rgba(23,_169,_148,_1),_0_10px_20px_rgba(204,_204,_204,_1)] rounded-3xl shadow-[10px_10px_1px_rgba(15,_118,_110,_1),_0_10px_20px_rgba(204,_204,_204,_1)]"
        wire:navigate>Register</a>
    @endif
  @endauth
</div>
