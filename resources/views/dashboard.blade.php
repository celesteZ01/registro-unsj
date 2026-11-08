<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inicio
        </h2>
    </x-slot>

    @role('admin', 'employee')
        Estás logueado como {{ auth()->user()->name }} y tu rol es {{ auth()->user()->role}}
    @endrole

    @role('customer')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="text-slate-800 text-sm">
                {!! $mensaje ?? 'Bienvenido a la tienda de mascotas Pet\'s Care, acá encontrarás todo lo que necesitas para tus peluditos.' !!}
            </div>
        </div>
    </div>
    @endrole
</x-app-layout>