<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="pb-[2rem] grid grid-cols-1 xl:grid-cols-[29rem_1fr]">
        @section('chat')
            <meta name="chat" content="{{ $chat->id }}">
        @endsection

        @include('chats')

        <div class="flex flex-col w-full">

            <div id="chat"></div>

        </div>

    </div>

</x-app-layout>
