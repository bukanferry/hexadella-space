<div class="max-w-2xl mx-auto relative z-10 pt-10">
    <div class="mb-12 text-center relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-purple-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(168,85,247,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
            Whisperella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-500 mb-4 tracking-tight relative z-10">
            IN-MEMORY CHAT
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Ephemeral chat without footprints. The room incinerates instantly once everyone disconnects.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "The most truthful conversations are those that leave no echoes."
        </p>

        @if (session()->has('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-xl inline-block">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-xl inline-block">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="whisperellaCreator()">
        <!-- Buat Ruangan -->
        <div class="bg-gray-900/80 backdrop-blur-md border border-gray-800 p-6 rounded-3xl shadow-xl flex flex-col justify-between relative overflow-hidden group">
            <div class="absolute inset-0 bg-purple-500/5 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500"></div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2 text-purple-400">Initialize Room (E2EE)</h3>
                <p class="text-gray-400 text-sm mb-6">Commence real-time encrypted dialogue. The cryptographic key is generated locally within your browser.</p>
            </div>
            
            <button @click="createSecureRoom" :disabled="isCreating" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-4 px-4 rounded-xl transition-colors flex items-center justify-center relative z-10 disabled:opacity-50 disabled:cursor-not-allowed">
                <span x-show="!isCreating">Initialize Room Now</span>
                <span x-show="isCreating" class="animate-pulse">Provisioning Encryption...</span>
                <svg x-show="!isCreating" class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                <div x-show="isCreating" class="w-5 h-5 ml-2 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            </button>
        </div>

        <!-- Gabung Ruangan -->
        <div class="bg-gray-900/80 backdrop-blur-md border border-gray-800 p-6 rounded-3xl shadow-xl flex flex-col justify-center items-center text-center">
            <div class="w-16 h-16 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-gray-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2 text-gray-200">How to Join?</h3>
            <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                Due to strict end-to-end encryption (E2EE), you require the <strong class="text-purple-400">Full URI</strong> containing the Decryption Key. Request the room initiator to securely transmit the link to you.
            </p>
        </div>
    </div>

    <script>
        function whisperellaCreator() {
            return {
                isCreating: false,
                
                async createSecureRoom() {
                    this.isCreating = true;
                    
                    try {
                        // 1. Generate 256-bit AES-GCM Key
                        const key = await window.crypto.subtle.generateKey(
                            { name: "AES-GCM", length: 256 },
                            true,
                            ["encrypt", "decrypt"]
                        );
                        const exportedKey = await window.crypto.subtle.exportKey("raw", key);
                        const keyBase64 = btoa(String.fromCharCode(...new Uint8Array(exportedKey))).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');

                        // 2. Generate Random Room Code (6 chars hex)
                        const codeBytes = window.crypto.getRandomValues(new Uint8Array(3));
                        const roomCode = Array.from(codeBytes).map(b => b.toString(16).padStart(2, '0')).join('');

                        // 3. Register Room in Backend
                        await this.$wire.createRoom(roomCode);

                        // 4. Redirect to Room with Key in Hash
                        window.location.href = '/whisperella/' + roomCode + '#' + keyBase64;
                    } catch (e) {
                        this.isCreating = false;
                        alert('Failed to provision E2EE room: ' + e.message);
                    }
                }
            }
        }
    </script>
</div>
