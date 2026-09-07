<div x-data="whisperellaRoom()" class="max-w-4xl mx-auto h-[85vh] flex flex-col bg-gray-900/80 backdrop-blur-md border border-gray-800 rounded-3xl overflow-hidden shadow-2xl shadow-purple-500/10 relative z-10 mt-4">
    
    <!-- Error Overlay -->
    <div x-show="errorMessage" style="display:none;" class="absolute inset-0 z-50 bg-gray-950/95 flex flex-col items-center justify-center p-6 text-center">
        <div class="w-16 h-16 bg-red-500/20 text-red-500 rounded-full flex items-center justify-center mb-4 border border-red-500/30">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-red-400 mb-2">Access Denied</h3>
        <p class="text-gray-300 max-w-sm" x-text="errorMessage"></p>
        <a href="{{ route('whisperella.index') }}" class="mt-6 px-6 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-xl transition-colors">Return</a>
    </div>

    <!-- Room Header -->
    <div class="px-6 py-4 bg-gray-950/80 border-b border-gray-800 backdrop-blur flex justify-between items-center z-20">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center border border-purple-500/30 shadow-sm relative">
                <div class="absolute inset-0 rounded-full border border-purple-400 animate-ping opacity-20"></div>
                <svg class="w-5 h-5 text-purple-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-100 tracking-tight flex items-center gap-2">
                    Whisperella <span class="px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[0.65rem] uppercase tracking-wider font-bold">E2EE</span>
                </h2>
                <div class="flex items-center space-x-2 text-xs">
                    <span class="text-gray-400">Sector: <span class="font-mono bg-gray-900 px-1 py-0.5 rounded border border-gray-700 text-purple-400">{{ $roomCode }}</span></span>
                </div>
            </div>
        </div>
        <button wire:click="destroyRoom" wire:confirm="Are you certain you wish to obliterate this sector immediately?" class="text-red-400 hover:text-red-300 hover:bg-red-900/30 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors border border-transparent hover:border-red-900/50">
            Obliterate
        </button>
    </div>

    <!-- Chat Messages -->
    <div class="flex-grow p-6 overflow-y-auto space-y-4" id="chat-container">
        @forelse($messages as $msg)
            @php $isMine = ($msg['sender_id'] ?? '') === $userId; @endphp
            <div wire:key="{{ $msg['id'] }}" 
                 x-data="whisperMessage('{{ $msg['encrypted_payload'] ?? '' }}', '{{ $msg['media_url'] ?? '' }}')" 
                 class="flex flex-col max-w-[80%] {{ $isMine ? 'ml-auto items-end' : 'mr-auto items-start' }}">
                
                @if(!$isMine)
                    <span class="text-[0.7rem] font-bold {{ $msg['color'] ?? 'text-gray-400' }} mb-1 ml-1 opacity-80">{{ $msg['alias'] ?? 'Anonymous' }}</span>
                @endif
                
                <div class="rounded-2xl p-3 max-w-[85%] {{ $isMine ? 'bg-purple-600/30 text-gray-100 shadow-md shadow-purple-900/20 rounded-br-sm border border-purple-500/30' : 'bg-gray-800/80 text-gray-200 shadow-sm border border-gray-700 rounded-bl-sm' }}">
                    
                    <!-- Media Decryption State -->
                    <template x-if="isDecryptingMedia">
                        <div class="w-48 h-32 bg-gray-900/50 rounded-xl mb-2 flex items-center justify-center border border-gray-700">
                            <div class="w-5 h-5 border-2 border-purple-400 border-t-transparent rounded-full animate-spin"></div>
                        </div>
                    </template>
                    
                    <template x-if="decryptedMediaUrl">
                        <img :src="decryptedMediaUrl" alt="Classified Attachment" class="w-full max-w-xs rounded-xl mb-2 object-cover border border-white/5 cursor-pointer hover:opacity-90 transition-opacity" @click="window.open(decryptedMediaUrl, '_blank')">
                    </template>
                    
                    <p class="text-[0.95rem] leading-relaxed break-words" x-text="decryptedText"></p>
                </div>
                
                <span class="text-[0.65rem] text-gray-500 mt-1 {{ $isMine ? 'mr-1' : 'ml-1' }}" 
                      x-data="{ time: '' }" 
                      x-init="time = new Date('{{ \Carbon\Carbon::parse($msg['timestamp'])->toISOString() }}').toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})" 
                      x-text="time">
                      {{ \Carbon\Carbon::parse($msg['timestamp'])->format('H:i') }}
                </span>
            </div>
        @empty
            <div class="h-full flex flex-col items-center justify-center text-gray-500 text-sm opacity-50">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                No transmissions yet. Initiate secure E2EE channel.
            </div>
        @endforelse
    </div>

    <!-- Message Input -->
    <div class="p-4 bg-gray-950/80 border-t border-gray-800 backdrop-blur">
        
        <div x-show="mediaFileName" style="display:none;" class="mb-2 px-3 py-1.5 bg-gray-900 border border-purple-500/30 rounded-xl inline-flex items-center space-x-2 text-sm text-gray-300 shadow-sm">
            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
            <span class="font-medium">Attachment: <span x-text="mediaFileName"></span></span>
            <button @click="mediaFileName = ''; $refs.fileInput.value = ''; $wire.set('media', null)" type="button" class="text-red-400 hover:text-red-300 hover:bg-red-900/30 p-1 rounded-md ml-2 transition-colors">Abort</button>
        </div>

        <div x-show="isEncryptingMedia" style="display:none;" class="mb-3 w-full bg-gray-900 border border-purple-500/30 rounded-xl p-3 shadow-inner">
            <div class="flex items-center text-xs text-purple-400 font-bold uppercase tracking-widest gap-2">
                <div class="w-4 h-4 border-2 border-purple-400 border-t-transparent rounded-full animate-spin"></div>
                <span>Ciphering Payload...</span>
            </div>
        </div>

        <form x-on:submit.prevent="sendMessage($refs.input.value); $refs.input.value = '';" class="flex items-end space-x-2">
            <input type="file" x-ref="fileInput" @change="encryptAndUploadMedia" id="media-upload" class="hidden" accept="image/*">
            <label for="media-upload" class="cursor-pointer bg-gray-900 border border-gray-700 hover:bg-gray-800 hover:border-purple-500/50 text-gray-400 hover:text-purple-400 p-3.5 rounded-2xl transition-all shadow-sm shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
            </label>
            <div class="flex-grow relative">
                <input x-ref="input" type="text" placeholder="Transmit ephemeral string..." 
                       class="w-full bg-gray-900 border border-gray-700 shadow-sm rounded-2xl px-5 py-3.5 text-gray-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all"
                       autocomplete="off">
            </div>
            <button type="submit" :disabled="isEncryptingMedia" class="bg-purple-600 hover:bg-purple-500 text-white p-3.5 rounded-2xl transition-all shadow-md shadow-purple-900/20 shrink-0 border border-purple-500/50 disabled:opacity-50">
                <svg class="w-5 h-5 translate-x-0.5 -translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </div>

    <script>
        function whisperellaRoom() {
            return {
                cryptoKey: null,
                keyBase64: '',
                errorMessage: '',
                mediaFileName: '',
                isEncryptingMedia: false,

                async init() {
                    const hash = window.location.hash.substring(1);
                    if (!hash) {
                        this.errorMessage = "Decryption key absent from URI. You lack clearance to read or transmit within this sector.";
                        return;
                    }
                    this.keyBase64 = hash;
                    try {
                        const bytes = Uint8Array.from(atob(hash.replace(/-/g, '+').replace(/_/g, '/')), c => c.charCodeAt(0));
                        this.cryptoKey = await window.crypto.subtle.importKey("raw", bytes, { name: "AES-GCM" }, true, ["encrypt", "decrypt"]);
                    } catch(e) {
                        this.errorMessage = "Decryption key corrupted or invalid.";
                    }
                },

                async encryptAndUploadMedia(event) {
                    const file = event.target.files[0];
                    if (!file || !this.cryptoKey) return;
                    
                    this.isEncryptingMedia = true;
                    this.mediaFileName = file.name;

                    try {
                        const arrayBuffer = await file.arrayBuffer();
                        const iv = window.crypto.getRandomValues(new Uint8Array(12));
                        const rawKey = window.Alpine ? Alpine.raw(this.cryptoKey) : this.cryptoKey;
                        const ciphertext = await window.crypto.subtle.encrypt({ name: "AES-GCM", iv: iv }, rawKey, arrayBuffer);

                        const encryptedBlob = new Blob([iv, ciphertext]);
                        const encryptedFile = new File([encryptedBlob], "media.dat", { type: "application/octet-stream" });

                        this.$wire.upload('media', encryptedFile, 
                            () => { this.isEncryptingMedia = false; },
                            () => { this.isEncryptingMedia = false; this.mediaFileName = ''; alert('Failed to upload payload'); }
                        );
                    } catch(e) {
                        this.isEncryptingMedia = false;
                        this.mediaFileName = '';
                        alert('Encryption failure: ' + e.message);
                    }
                },

                async sendMessage(text) {
                    if (!text && !this.mediaFileName) return;
                    if (!this.cryptoKey) {
                        alert('Access Denied: Encryption key unavailable.');
                        return;
                    }

                    try {
                        const payloadObj = { text: text };
                        const payloadStr = JSON.stringify(payloadObj);
                        const encoder = new TextEncoder();
                        const payloadBytes = encoder.encode(payloadStr);

                        const iv = window.crypto.getRandomValues(new Uint8Array(12));
                        const rawKey = window.Alpine ? Alpine.raw(this.cryptoKey) : this.cryptoKey;
                        const ciphertext = await window.crypto.subtle.encrypt({ name: "AES-GCM", iv: iv }, rawKey, payloadBytes);

                        const combined = new Uint8Array(iv.length + ciphertext.byteLength);
                        combined.set(iv);
                        combined.set(new Uint8Array(ciphertext), iv.length);
                        const base64Payload = btoa(String.fromCharCode(...combined));

                        await this.$wire.sendMessage(base64Payload, this.mediaFileName !== '');
                        
                        this.mediaFileName = '';
                        this.$refs.fileInput.value = '';
                    } catch(e) {
                        alert('Encryption failure: ' + e.message);
                    }
                }
            }
        }

        function whisperMessage(encryptedPayloadBase64, mediaUrl) {
            return {
                decryptedText: '',
                decryptedMediaUrl: null,
                isDecryptingMedia: false,

                async init() {
                    const hash = window.location.hash.substring(1);
                    if (!hash) { this.decryptedText = "Failure: Key Missing"; return; }
                    
                    try {
                        const bytes = Uint8Array.from(atob(hash.replace(/-/g, '+').replace(/_/g, '/')), c => c.charCodeAt(0));
                        const cryptoKey = await window.crypto.subtle.importKey("raw", bytes, { name: "AES-GCM" }, true, ["encrypt", "decrypt"]);

                        if (encryptedPayloadBase64) {
                            const combined = Uint8Array.from(atob(encryptedPayloadBase64), c => c.charCodeAt(0));
                            const iv = combined.slice(0, 12);
                            const ciphertext = combined.slice(12);
                            const decrypted = await window.crypto.subtle.decrypt({ name: "AES-GCM", iv: iv }, cryptoKey, ciphertext);
                            const payloadObj = JSON.parse(new TextDecoder().decode(decrypted));
                            this.decryptedText = payloadObj.text || '';
                        }
                    } catch(e) {
                        this.decryptedText = 'Corrupted/Decryption Failed';
                    }

                    if (mediaUrl) {
                        this.isDecryptingMedia = true;
                        try {
                            const response = await fetch(mediaUrl);
                            const buffer = await response.arrayBuffer();
                            const iv = buffer.slice(0, 12);
                            const ciphertext = buffer.slice(12);
                            
                            const bytes = Uint8Array.from(atob(hash.replace(/-/g, '+').replace(/_/g, '/')), c => c.charCodeAt(0));
                            const cryptoKey = await window.crypto.subtle.importKey("raw", bytes, { name: "AES-GCM" }, true, ["encrypt", "decrypt"]);
                            const decrypted = await window.crypto.subtle.decrypt({ name: "AES-GCM", iv: iv }, cryptoKey, ciphertext);
                            
                            const blob = new Blob([decrypted]);
                            this.decryptedMediaUrl = URL.createObjectURL(blob);
                        } catch(e) {
                            console.error('Failed to decrypt media', e);
                        }
                        this.isDecryptingMedia = false;
                    }
                }
            }
        }
    </script>
</div>

@script
<script>
    let container = document.getElementById('chat-container');
    if (container) { container.scrollTop = container.scrollHeight; }
    $wire.on('message-sent', () => { setTimeout(() => { if (container) { container.scrollTop = container.scrollHeight; } }, 50); });
</script>
@endscript
