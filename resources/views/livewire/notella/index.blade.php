<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen"
     x-data="{
        plaintext: '',
        encryptionKeyBase64: '',
        isEncrypting: false,
        async encryptAndSubmit() {
            if (!this.plaintext.trim()) return;
            this.isEncrypting = true;
            try {
                const key = await window.crypto.subtle.generateKey(
                    { name: 'AES-GCM', length: 256 }, true, ['encrypt', 'decrypt']
                );
                const rawKey = await window.crypto.subtle.exportKey('raw', key);
                const keyArray = new Uint8Array(rawKey);
                let keyStr = '';
                for (let i = 0; i < keyArray.length; i++) keyStr += String.fromCharCode(keyArray[i]);
                this.encryptionKeyBase64 = btoa(keyStr);
                
                const iv = window.crypto.getRandomValues(new Uint8Array(12));
                const data = new TextEncoder().encode(this.plaintext);
                const encryptedBuf = await window.crypto.subtle.encrypt({ name: 'AES-GCM', iv: iv }, key, data);
                
                const payload = new Uint8Array(iv.length + encryptedBuf.byteLength);
                payload.set(iv, 0);
                payload.set(new Uint8Array(encryptedBuf), iv.length);
                
                let payloadStr = '';
                for (let i = 0; i < payload.length; i++) payloadStr += String.fromCharCode(payload[i]);
                $wire.content = btoa(payloadStr);
                await $wire.submit();
            } catch (e) {
                console.error(e);
                alert('Client-Side Encryption failure.');
            }
            this.isEncrypting = false;
        },
        getFullUrl(slug) {
            return window.location.origin + '/n/' + slug + '#' + this.encryptionKeyBase64;
        }
     }">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-cyan-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-cyan-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(6,182,212,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            Notella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight relative z-10">
            BURN-AFTER-READING NOTE
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Transmit encrypted classified messages. Incinerated instantly upon extraction.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "A classified transmission that sacrifices its existence to preserve your secrecy."
        </p>
    </div>

    <!-- Main Form -->
    <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up">
        @if($generatedSlug)
            <div class="text-center py-8">
                <div class="w-20 h-20 rounded-full bg-cyan-900/30 border border-cyan-500/30 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-100 mb-2">URI Ready for Distribution!</h2>
                <p class="text-gray-400 text-sm mb-8 max-w-md mx-auto">
                    Copy the URI below and transmit it to the recipient. The message will auto-incinerate instantly upon extraction, or within {{ $expiresIn }} minutes if unread.
                </p>

                <div class="flex items-center gap-2 max-w-xl mx-auto bg-gray-950 p-2 rounded-xl border border-gray-800" x-data="{ copied: false }">
                    <input type="text" readonly :value="getFullUrl('{{ $generatedSlug }}')" class="w-full bg-transparent border-none text-cyan-400 text-sm md:text-base font-mono focus:ring-0" id="notella-link" x-ref="linkInput">
                    <button @click="navigator.clipboard.writeText($refs.linkInput.value); copied = true; setTimeout(() => copied = false, 2000)" class="px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-lg font-bold text-sm transition-colors flex-shrink-0 flex items-center gap-2">
                        <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                        <svg x-show="copied" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span x-text="copied ? 'Copied!' : 'Copy'"></span>
                    </button>
                </div>
                
                <button wire:click="$set('generatedSlug', null)" class="mt-8 text-gray-500 hover:text-cyan-400 text-sm font-medium transition-colors">
                    Draft New Transmission
                </button>
            </div>
        @else
            <form @submit.prevent="encryptAndSubmit" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Your Classified Message</label>
                    <textarea x-model="plaintext" rows="6" maxlength="10000" class="w-full bg-gray-950/50 border border-gray-800 rounded-xl px-4 py-3 text-gray-300 placeholder-gray-600 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 transition-all resize-none" placeholder="Input confessions, credentials, or classified intel here... (Encryption executed 100% client-side)"></textarea>
                    @error('content') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Incinerate if unread within</label>
                        <select wire:model="expiresIn" class="w-full bg-gray-950/50 border border-gray-800 rounded-xl px-4 py-3 text-gray-300 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 transition-all appearance-none cursor-pointer">
                            <option value="10">10 Minutes</option>
                            <option value="60">1 Hour</option>
                            <option value="1440">1 Day</option>
                            <option value="10080">7 Days</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" :disabled="isEncrypting" class="w-full bg-cyan-600 hover:bg-cyan-500 disabled:bg-cyan-800 disabled:text-gray-400 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-[0_0_20px_rgba(6,182,212,0.3)] hover:shadow-[0_0_30px_rgba(6,182,212,0.5)] flex items-center justify-center gap-2">
                            <svg x-show="!isEncrypting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <svg x-show="isEncrypting" class="animate-spin -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span x-text="isEncrypting ? 'Ciphering (E2EE)...' : 'Cipher & Generate URI'"></span>
                        </button>
                    </div>
                </div>
            </form>
            
            <!-- Warning -->
            <div class="mt-8 pt-6 border-t border-gray-800 flex items-start gap-4 p-4 rounded-xl bg-gray-950/50">
                <div class="w-10 h-10 rounded-full bg-cyan-900/30 flex items-center justify-center flex-shrink-0 text-cyan-500 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-200 mb-1">Zero-Knowledge & Client-Side Encryption (E2EE)</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Your transmission is absolutely encrypted within your browser utilizing the <strong>AES-GCM 256-bit</strong> algorithm. The generated URI will contain a `#key` fragment. Our servers solely receive random ciphertext and remain completely ignorant of the message content or decryption key.
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
