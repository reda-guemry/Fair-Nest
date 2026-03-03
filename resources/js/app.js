import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

// Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    if (!window.Livewire || !window.Livewire.components.count()) {
        Alpine.start();
    }
});

const colocationId = document.getElementById('app').dataset.colocationId;
// console.log(colocationId);


window.Echo.private(`colocation.${colocationId}`).listen(
    "NewMessageSent",
    (e) => {
        console.log("New message received:", e);

        appendMessageToChat(e);
    },
);
function appendMessageToChat(incomingData) {
    const data = incomingData.message ? incomingData.message : incomingData;

    const chatWindow = document.getElementById("chat-window");
    if (!chatWindow) return; 
    
    const container = chatWindow.querySelector('.flex-col') || chatWindow;
    const currentUserId = window.currentUserId; 
    
    if (!data.userDTO) {
        console.error("userDTO is missing in the data:", data);
        return;
    }

    const isMe = data.userId == currentUserId;
    const profileUrl = `/storage/profiles/${data.userDTO.profilePhoto || 'defaultPng.jpg'}`;
    const userName = data.userDTO.name;

    const fileUrl = data.filePath ? `/storage/attachments/${data.filePath}` : null;

    let attachmentHtml = '';
    if (fileUrl) {
        if (data.type === 'image') {
            attachmentHtml = `<div class="mt-2"><a href="${fileUrl}" target="_blank"><img src="${fileUrl}" class="rounded-xl max-h-64 w-auto object-cover border border-black/10"></a></div>`;
        } else if (data.type === 'video') {
            attachmentHtml = `<div class="mt-2"><video controls class="rounded-xl max-h-64 w-full bg-black"><source src="${fileUrl}"></video></div>`;
        } else {
            const ext = data.filePath.split('.').pop().toUpperCase();
            attachmentHtml = `
                <div class="mt-2">
                    <a href="${fileUrl}" download class="flex items-center gap-3 p-3 rounded-xl ${isMe ? 'bg-white/10' : 'bg-gray-50'}">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center ${isMe ? 'bg-white/20' : 'bg-orange-100'}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="flex flex-col min-w-0 flex-1 text-left">
                            <span class="text-xs font-bold truncate">Document</span>
                            <span class="text-[10px] opacity-70 uppercase font-black">${ext}</span>
                        </div>
                    </a>
                </div>`;
        }
    }

    const messageHtml = `
        <div class="flex w-full ${isMe ? 'justify-end' : 'justify-start'} mb-4 animate-fade-in-up">
            <div class="flex max-w-[85%] sm:max-w-[75%] ${isMe ? 'flex-row-reverse' : 'flex-row'} items-end gap-3">
                <img src="${profileUrl}" class="w-8 h-8 rounded-full object-cover border border-gray-100 shadow-sm shrink-0 mb-1">
                <div class="flex flex-col ${isMe ? 'items-end' : 'items-start'}">
                    ${!isMe ? `<span class="text-[10px] font-bold text-gray-400 ml-1 mb-1 uppercase tracking-tighter">${userName}</span>` : ''}
                    <div class="px-4 py-3 rounded-[1.5rem] shadow-sm text-sm leading-relaxed ${isMe ? 'bg-[#1A1A1A] text-white rounded-br-none' : 'bg-white text-gray-700 border border-gray-100 rounded-bl-none'}">
                        ${data.content ? `<p class="${fileUrl ? 'mb-2' : ''}">${data.content}</p>` : ''}
                        ${attachmentHtml}
                    </div>
                    <span class="text-[9px] font-medium text-gray-400 mt-1 px-1">
                        ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                    </span>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML("beforeend", messageHtml);
    
    chatWindow.scrollTo({
        top: chatWindow.scrollHeight,
        behavior: 'smooth'
    });
}
