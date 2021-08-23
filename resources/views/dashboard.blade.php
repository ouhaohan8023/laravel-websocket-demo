<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset("js/app.js")}}"></script>

    <script>
        Echo.private('channel-name.1')
            .listen('.server.created', (e) => {
                console.log("channel 1");
                console.log(e);
            });
        Echo.channel('channel-name.2')
            .listen('.server.created', (e) => {
                console.log("channel 2");
                console.log(e);
            });

    </script>
</x-app-layout>
