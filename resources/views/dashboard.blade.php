<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full leading-normald">
                        <tbody>
                            @foreach ($infosTableau as $info)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="font-bold">{{ $info['label'] }} :</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <span class="{{ $info['green'] ?? false ? 'text-green-500' : ''}}{{ $info['red'] ?? false ? 'text-red-500' : ''}}">
                                        {{ $info['value'] }}{{ $info['euro'] ?? false ? ' €' : '' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>