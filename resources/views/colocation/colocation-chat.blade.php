<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('colocation.show', $colocation->id) }}"
                    class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-[#1A1A1A] transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-extrabold text-2xl text-[#1A1A1A] tracking-tight line-height-1">Discussion d'équipe
                    </h2>
                    <p class="text-xs font-medium text-gray-400">{{ $colocation->name }} •
                        {{ count($colocation->membership) }} membres
                    </p>
                </div>
            </div>

            <div class="hidden sm:flex -space-x-2">
                @foreach (collect($colocation->membership)->take(3) as $member)
                    <img class="w-8 h-8 rounded-full border-2 border-white shadow-sm"
                        src="{{ asset('storage/profiles/' . $member->profilePhoto) }}" title="{{ $member->name }}">
                @endforeach
                @if (count($colocation->membership) > 3)
                    <div
                        class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500">
                        +{{ count($colocation->membership) - 3 }}</div>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="chatHandler()"
            class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)] border border-gray-100 flex flex-col overflow-hidden h-[calc(100vh-200px)]">

            <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-[#FAF9F6]/30 custom-scrollbar scroll-smooth"
                id="chat-window">
                <div class="flex flex-col gap-4">
                    @forelse($colocation->messages as $message)
                                    @php
                                        $isMe = $message->userId === auth()->id();
                                        $sender = collect($colocation->membership)->firstWhere('userId', $message->userId);
                                        $fileUrl = $message->filePath ? asset('storage/attachments/' . $message->filePath) : null;
                                    @endphp

                                    <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                        <div
                                            class="flex max-w-[85%] sm:max-w-[75%] {{ $isMe ? 'flex-row-reverse' : 'flex-row' }} items-end gap-3">

                                            <img src="{{ asset('storage/profiles/' . ($sender->profilePhoto ?? 'default.png')) }}"
                                                class="w-8 h-8 rounded-full object-cover border border-gray-100 shadow-sm shrink-0 mb-1">

                                            <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">

                                                @if(!$isMe)
                                                    <span class="text-[10px] font-bold text-gray-400 ml-1 mb-1 uppercase tracking-tighter">
                                                        {{ $sender->name ?? 'Membre' }}
                                                    </span>
                                                @endif

                                                <div class="px-4 py-3 rounded-[1.5rem] shadow-sm text-sm leading-relaxed overflow-hidden
                                            {{ $isMe
                        ? 'bg-[#1A1A1A] text-white rounded-br-none'
                        : 'bg-white text-gray-700 border border-gray-100 rounded-bl-none' }}">

                                                    @if($message->content)
                                                        <p class="{{ $message->filePath ? 'mb-3' : '' }}">
                                                            {{ $message->content }}
                                                        </p>
                                                    @endif

                                                    @if($message->filePath)
                                                        <div class="mt-1">
                                                            @if($message->type === 'image')
                                                                <a href="{{ $fileUrl }}" target="_blank" class="block group relative">
                                                                    <img src="{{  $fileUrl }}"
                                                                        class="rounded-xl max-h-64 w-auto object-cover border border-black/10 group-hover:opacity-90 transition-opacity">
                                                                </a>

                                                            @elseif($message->type === 'video')
                                                                <video controls class="rounded-xl max-h-64 w-full bg-black">
                                                                    <source src="{{ $fileUrl }}">
                                                                    Your browser does not support the video tag.
                                                                </video>

                                                            @else
                                                                <a href="{{ $fileUrl }}" download target="_blank"
                                                                    class="flex items-center gap-3 p-3 rounded-xl transition-all
                                                                   {{ $isMe ? 'bg-white/10 hover:bg-white/20' : 'bg-gray-50 hover:bg-gray-100 border border-gray-100' }}">

                                                                    <div
                                                                        class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                                                        {{ $isMe ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-600' }}">
                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>

                                                                    <div class="flex flex-col min-w-0 flex-1">
                                                                        <span class="text-xs font-bold truncate pr-2">Document</span>
                                                                        <span class="text-[10px] opacity-70 uppercase font-black">
                                                                            {{ pathinfo($message->filePath, PATHINFO_EXTENSION) ?: 'FILE' }}
                                                                        </span>
                                                                    </div>

                                                                    <svg class="w-5 h-5 opacity-50 shrink-0" fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <span class="text-[9px] font-medium text-gray-400 mt-1 px-1">
                                                    {{ \Carbon\Carbon::parse($message->createdAt)->format('h:i A') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full py-20 opacity-40">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium text-sm">Aucun message pour le moment</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-4 bg-white border-t border-gray-100">
                <form action="{{ route('colocation.chat.send', $colocation->id) }}" method="POST"
                    enctype="multipart/form-data" x-data="chatHandler()"
                    @submit="setTimeout(() => { if(!event.defaultPrevented) removeFile() }, 100)">

                    @csrf

                    <div x-show="filePreview" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-4"
                        x-transition:leave="transition ease-in duration-200"
                        class="mb-4 p-3 bg-orange-50/50 rounded-2xl border border-orange-100 flex items-center justify-between">

                        <div class="flex items-center gap-3">
                            <template x-if="isImage">
                                <img :src="filePreview"
                                    class="w-12 h-12 rounded-lg object-cover border-2 border-white shadow-sm">
                            </template>
                            <template x-if="!isImage">
                                <div
                                    class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </template>
                            <div>
                                <p class="text-sm font-bold text-orange-800 x-text=" fileName"
                                    class="truncate max-w-[150px]"></p>
                                <p class="text-[10px] text-orange-600 uppercase font-black" x-text="fileSize"></p>
                            </div>
                        </div>

                        <button type="button" @click="removeFile()"
                            class="p-2 bg-white text-red-500 rounded-full hover:bg-red-50 transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-3">

                        <label
                            class="shrink-0 w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 hover:text-orange-500 hover:bg-orange-50 cursor-pointer transition-all border border-gray-100">
                            <input type="file" name="attachment" id="fileInput" class="hidden"
                                @change="handleFileUpload">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                </path>
                            </svg>
                        </label>

                        <div class="relative flex-1">

                            <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <input type="text" name="message" placeholder="Écrivez votre message..." required
                                class="w-full bg-gray-50 border-none rounded-full py-3.5 px-6 text-sm font-medium text-gray-700 focus:ring-4 focus:ring-orange-500/10 placeholder-gray-400 transition-all">
                        </div>

                        <button type="submit"
                            class="shrink-0 w-12 h-12 bg-[#1A1A1A] text-white rounded-full flex items-center justify-center hover:scale-105 active:scale-95 transition-all shadow-lg shadow-black/10">
                            <svg class="w-5 h-5 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function chatHandler() {
            return {
                filePreview: null,
                fileName: '',
                fileSize: '',
                isImage: false,

                handleFileUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    this.fileName = file.name;
                    this.fileSize = (file.size / 1024).toFixed(1) + ' KB';
                    this.isImage = file.type.startsWith('image/');

                    if (this.isImage) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.filePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        this.filePreview = true;
                    }
                },

                removeFile() {
                    this.filePreview = null;
                    this.fileName = '';
                    this.fileSize = '';
                }
            }
        }
    </script>
</x-app-layout>