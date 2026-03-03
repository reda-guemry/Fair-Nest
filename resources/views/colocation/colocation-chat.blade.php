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
                        {{ count($colocation->membership) }} membres</p>
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

            <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-[#FAF9F6]/30" id="chat-window">
    @foreach($colocation->messages as $message)
        @php
            $isMe = $message->userId === auth()->id();
            $sender = collect($colocation->membership)->firstWhere('id', $message->userId);
        @endphp

        <div class="flex items-end gap-3 max-w-[80%] {{ $isMe ? 'ml-auto flex-row-reverse' : '' }}">
            <img src="{{ $sender && $sender->profilePhoto ? asset('storage/profiles/' . $sender->profilePhoto) : 'https://ui-avatars.com/api/?name=' . ($sender->name ?? 'User') }}" 
                 class="w-8 h-8 rounded-full shadow-sm mb-1">

            <div class="flex flex-col {{ $isMe ? 'items-end' : '' }}">
                @if(!$isMe)
                    <p class="text-[10px] font-bold text-gray-400 ml-1 mb-1 uppercase tracking-widest">
                        {{ $sender->name ?? 'Membre' }}
                    </p>
                @endif

                <div class="{{ $isMe ? 'bg-[#1A1A1A] text-white' : 'bg-white border border-gray-100 text-gray-700' }} p-4 rounded-[1.5rem] {{ $isMe ? 'rounded-br-none' : 'rounded-bl-none' }} shadow-sm">
                    
                    @if($message->type === 'text')
                        <p class="text-sm leading-relaxed">{{ $message->content }}</p>
                    @endif

                    @if($message->type === 'file' && $message->filePath)
                        @php
                            $extension = pathinfo($message->filePath, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'ogg']);
                        @endphp

                        <div class="mt-2">
                            @if($isImage)
                                <img src="{{ asset('storage/' . $message->filePath) }}" 
                                     class="rounded-xl max-w-full h-auto border border-gray-200">
                            @elseif($isVideo)
                                <video controls class="rounded-xl max-w-full">
                                    <source src="{{ asset('storage/' . $message->filePath) }}" type="video/{{ $extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <a href="{{ asset('storage/' . $message->filePath) }}" target="_blank" 
                                   class="flex items-center gap-2 p-2 bg-gray-50/10 rounded-lg border border-white/20 hover:bg-white/20 transition-colors">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs font-medium underline">Voir le document ({{ strtoupper($extension) }})</span>
                                </a>
                            @endif

                            @if($message->content)
                                <p class="text-sm mt-2 opacity-90">{{ $message->content }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <span class="text-[9px] text-gray-400 mt-1 {{ $isMe ? 'mr-1' : 'ml-1' }}">
                    {{ \Carbon\Carbon::parse($message->createdAt)->format('H:i A') }}
                    {{ $isMe ? ' • Lu' : '' }}
                </span>
            </div>
        </div>
    @endforeach
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
                                <p class="text-sm font-bold text-orange-800 x-text="fileName"
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
                            <svg class="w-5 h-5 translate-x-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
