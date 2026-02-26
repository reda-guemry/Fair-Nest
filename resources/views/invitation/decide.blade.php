<x-guest-layout>
    <div class="text-center p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Invitation reçue !</h2>
        <p class="mb-6 text-gray-600">
            {{ Auth::user()->first_name }}, vous avez été invité à rejoindre la colocation 
            <strong>#{{ $invitation->colocationId }}</strong>.
        </p>

        <form action="{{ route('invitation.process') }}" method="POST" class="flex justify-center gap-4">
            @csrf
            <input type="hidden" name="token" value="{{ $invitation->token }}">

            
            <button name="action" value="accept" class="bg-indigo-600 text-white px-6 py-2 rounded-full font-bold hover:bg-indigo-700">
                Accepter
            </button>

            <button name="action" value="refuse" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full font-bold hover:bg-gray-300">
                Refuser
            </button>
        </form>
    </div>
</x-guest-layout>