<div class="flex flex-col items-center justify-center pt-8 pb-20 z-10 relative">
    <div class="w-full max-w-xl px-4">
        <!-- Header -->
        <div class="text-center mb-10 opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="w-16 h-16 rounded-2xl bg-gray-900 border border-emerald-500/30 flex items-center justify-center mx-auto mb-6 text-emerald-400 shadow-[0_0_30px_rgba(16,185,129,0.15)] relative">
                <div class="absolute inset-0 bg-emerald-400/20 rounded-2xl blur-xl animate-pulse"></div>
                <svg class="w-8 h-8 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-extrabold text-gray-100 tracking-tight mb-3">Vaultella (E2EE)</h1>
        </div>

        @if($notFound)
            <!-- Destroyed / Not Found State -->
            <div class="bg-gray-900/80 backdrop-blur-md p-10 rounded-3xl border border-rose-500/30 shadow-2xl shadow-rose-900/10 text-center opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="w-20 h-20 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center mx-auto mb-6 text-rose-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-100 mb-3">Payload Incinerated</h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-md mx-auto">
                    This payload is no longer available. It has either expired or been successfully extracted, triggering permanent systemic incineration.
                </p>
                <a href="{{ route('vaultella.index') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-3 px-8 rounded-xl transition-colors border border-gray-700 text-sm">
                    Return to Vault Core
                </a>
            </div>
        @else
            <!-- Ready to Download State (Managed by Alpine) -->
            <div x-data="vaultellaDownloader('{{ $uuid }}', '{{ $encryptedFilename }}')" x-init="init()" class="bg-gray-900/80 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-2xl text-center relative overflow-hidden group opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-emerald-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                
                <template x-if="!isDestroyed">
                    <div>
                        <h2 class="text-xl font-bold text-gray-100 mb-6">A Classified Payload Awaits Extraction</h2>
                        
                        <div class="bg-gray-950/60 backdrop-blur-sm border border-emerald-900/30 rounded-2xl p-6 mb-8 text-left inline-flex flex-col min-w-[80%] mx-auto relative z-10 shadow-inner">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-900/80 border border-gray-800 flex items-center justify-center text-emerald-500 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <!-- Show decrypted filename, or fallback if still decrypting/error -->
                                    <h3 class="text-gray-200 font-bold truncate text-base" x-text="realFilename">Decrypting Filename...</h3>
                                    <div class="flex items-center text-xs text-gray-400 mt-1.5 gap-3 font-medium">
                                        <span class="text-emerald-500/80">Ready for local extraction</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-show="errorMessage" style="display:none;" class="text-rose-400 text-xs mb-4 block text-center font-medium" x-text="errorMessage"></div>

                        <div class="space-y-4 relative z-10">
                            <button @click="downloadAndDecrypt()" :disabled="isDownloading" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-400 font-bold py-4 px-8 rounded-xl transition-colors border border-emerald-500/30 hover:shadow-[0_0_20px_rgba(16,185,129,0.2)] disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg x-show="!isDownloading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <div x-show="isDownloading" class="w-5 h-5 border-2 border-emerald-400 border-t-transparent rounded-full animate-spin"></div>
                                <span x-text="isDownloading ? 'Decrypting & Extracting...' : 'Decrypt & Incinerate'"></span>
                            </button>
                            <p class="text-[0.7rem] text-rose-400/80 font-medium max-w-sm mx-auto uppercase tracking-wide">WARNING: Payload will be permanently incinerated from the server upon extraction.</p>
                        </div>
                    </div>
                </template>

                <template x-if="isDestroyed">
                    <!-- Successfully Downloaded & Destroyed State -->
                    <div class="text-center animate-fade-in-up">
                        <div class="w-20 h-20 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mx-auto mb-6 text-emerald-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-100 mb-3">Extraction Successful!</h2>
                        <p class="text-emerald-400/80 text-sm font-medium tracking-wide mb-6 uppercase">Automated Incineration Protocol Executed</p>
                        <p class="text-gray-400 text-sm leading-relaxed mb-8 max-w-md mx-auto">
                            Payload has been decrypted and extracted locally. Concurrently, the original asset and its metadata have been <strong class="text-gray-200">permanently incinerated</strong> from our servers.
                        </p>
                        <a href="{{ route('vaultella.index') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-3 px-8 rounded-xl transition-colors border border-gray-700 text-sm">
                            Return to Vault Core
                        </a>
                    </div>
                </template>
            </div>
            
            <script>
                function vaultellaDownloader(uuid, encryptedFilenameBase64) {
                    return {
                        uuid: uuid,
                        encryptedFilenameBase64: encryptedFilenameBase64,
                        realFilename: 'Decrypting Filename...',
                        keyBase64: '',
                        cryptoKey: null,
                        isDownloading: false,
                        isDestroyed: false,
                        errorMessage: '',

                        async init() {
                            console.log("Vaultella init()");
                            // Extract key from URL hash
                            const hash = window.location.hash.substring(1);
                            if (!hash) {
                                this.errorMessage = 'Decryption key missing from URI. Extraction is impossible.';
                                this.realFilename = 'Vault Breach Failed';
                                return;
                            }

                            this.keyBase64 = hash;

                            try {
                                // Import the AES-GCM key
                                const binaryString = atob(this.keyBase64.replace(/-/g, '+').replace(/_/g, '/'));
                                const bytes = new Uint8Array(binaryString.length);
                                for (let i = 0; i < binaryString.length; i++) {
                                    bytes[i] = binaryString.charCodeAt(i);
                                }

                                this.cryptoKey = await window.crypto.subtle.importKey(
                                    "raw",
                                    bytes,
                                    { name: "AES-GCM" },
                                    true,
                                    ["encrypt", "decrypt"]
                                );

                                // Decrypt the filename
                                const binaryFilename = atob(this.encryptedFilenameBase64);
                                const filenameBytes = new Uint8Array(binaryFilename.length);
                                for (let i = 0; i < binaryFilename.length; i++) {
                                    filenameBytes[i] = binaryFilename.charCodeAt(i);
                                }

                                const filenameIv = filenameBytes.slice(0, 12);
                                const filenameCiphertext = filenameBytes.slice(12);

                                const decryptedFilenameBuffer = await window.crypto.subtle.decrypt(
                                    { name: "AES-GCM", iv: filenameIv },
                                    window.Alpine ? Alpine.raw(this.cryptoKey) : this.cryptoKey,
                                    filenameCiphertext
                                );

                                const decoder = new TextDecoder();
                                this.realFilename = decoder.decode(decryptedFilenameBuffer);

                            } catch (e) {
                                this.errorMessage = 'Decryption key invalid or payload corrupted.';
                                this.realFilename = 'Failed to Decrypt Filename';
                                console.error(e);
                                alert('Error init: ' + e.message);
                            }
                        },

                        async downloadAndDecrypt() {
                            if (!this.cryptoKey) return;
                            this.isDownloading = true;
                            this.errorMessage = '';

                            try {
                                // Fetch the encrypted blob from the API
                                const response = await fetch(`/api/vault/blob/${this.uuid}`);
                                if (!response.ok) {
                                    throw new Error('Failed to extract payload. It may have already been incinerated.');
                                }

                                const encryptedBuffer = await response.arrayBuffer();

                                // Extract IV and Ciphertext
                                const fileIv = encryptedBuffer.slice(0, 12);
                                const fileCiphertext = encryptedBuffer.slice(12);

                                // Decrypt
                                const decryptedBuffer = await window.crypto.subtle.decrypt(
                                    { name: "AES-GCM", iv: fileIv },
                                    window.Alpine ? Alpine.raw(this.cryptoKey) : this.cryptoKey,
                                    fileCiphertext
                                );

                                // Trigger native download
                                const blob = new Blob([decryptedBuffer], { type: 'application/octet-stream' });
                                const url = URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.href = url;
                                a.download = this.realFilename || 'vault_decrypted.dat';
                                document.body.appendChild(a);
                                a.click();
                                window.URL.revokeObjectURL(url);
                                document.body.removeChild(a);

                                // Mark as destroyed
                                this.isDownloading = false;
                                this.isDestroyed = true;

                            } catch (e) {
                                this.isDownloading = false;
                                this.errorMessage = 'Extraction/decryption failure: ' + (e.message || 'Unknown Error');
                                console.error(e);
                                alert('Failure: ' + (e.message || 'Unknown Error'));
                            }
                        }
                    }
                }
            </script>
        @endif
    </div>
</div>
