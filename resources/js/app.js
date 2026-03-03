import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

// Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    if (!window.Livewire || !window.Livewire.components.count()) {
        Alpine.start();
    }
});

window.Echo.private(`colocation.${colocationId}`).listen(
    "NewMessageSent",
    (e) => {
        console.log("New message received:", e);

        appendMessageToChat(e);
    },
);

function appendMessageToChat(data) {
    const isMe = data.user_id == currentUserId;
    const chatContainer = document.getElementById("chat-container");

    const html = `
        <div class="message ${isMe ? "sent" : "received"}">
            <img src="${data.user_photo}" class="avatar">
            <div class="bubble">
                <strong>${data.user_name}</strong>
                <p>${data.content}</p>
            </div>
        </div>
    `;

    chatContainer.insertAdjacentHTML("beforeend", html);
}
