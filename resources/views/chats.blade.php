<div class="max-w-full">

  <div id="vueFilter"></div> 

  <form method="post" action="{{ route('chat.create') }}"
      class="flex flex-col gap-4 sm:px-6 lg:px-8 max-w-[32rem] w-full my-[2rem]">
      @csrf
      <div>
          <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="chatName">
              Создать чат
          </label>
          <input
              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
              id="chatName" name="name" type="text" required>
      </div>
      <button type="submit"
          class="inline-flex items-center px-4 py-4 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
          Создать чат
      </button>
  </form>

  <div class="max-h-[35rem] overflow-auto">
    @foreach ($chats as $chat)
        <div class="py-2 cursor-pointer">
            <a href="{{route('chat', $chat->id)}}" @class(['active-nav' => route('chat', $chat->id) === url()->current(), 'block max-w-[32rem] sm:px-6 lg:px-8 '])>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg dark:hover:brightness-200 hover:brightness-50">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ $chat->name }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
  </div>
</div>