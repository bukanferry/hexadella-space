<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen flex flex-col items-center justify-center">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] left-[-10%] w-[500px] h-[500px] bg-emerald-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <div class="w-full max-w-2xl px-4 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12 relative animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
            <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
                <svg class="w-10 h-10 text-emerald-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(16,185,129,0.1)] relative z-10">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Vaultella (E2EE)
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-500 mb-4 tracking-tight relative z-10">
                BURN-AFTER-DOWNLOAD VAULT
            </h1>
            <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
                Ephemeral storage with End-to-End Encryption. Payloads are encrypted locally in your browser.
            </p>
        </div>

        <div x-data="vaultellaUploader()" x-init="init()" class="relative z-10">
            <!-- Loading / Encrypting Overlay -->
            <div x-show="isEncrypting" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-950/80 backdrop-blur-sm">
                <div class="text-center">
                    <div class="w-16 h-16 border-4 border-emerald-500/30 border-t-emerald-500 rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="text-emerald-400 font-bold tracking-widest uppercase text-sm animate-pulse">Ciphering Payload Locally...</p>
                    <p class="text-gray-500 text-xs mt-2">Standby, browser RAM is executing cryptography.</p>
                </div>
            </div>

            <!-- Alpine-managed UI -->
            <template x-if="!uuid">
                <div class="bg-gray-900/80 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-2xl hover:border-emerald-500/30 transition-all duration-300">
                    <div class="mb-8 relative overflow-hidden">
                        <input type="file" x-ref="fileInput" @change="handleFileSelect" id="file-upload" class="hidden" accept="*/*">
                        <label for="file-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-800 border-dashed rounded-2xl cursor-pointer bg-gray-950/50 hover:bg-gray-900/80 hover:border-emerald-500/50 transition-all duration-300 group relative overflow-hidden">
                            <div class="absolute inset-0 bg-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <template x-if="selectedFile">
                                <div class="flex flex-col items-center relative z-10">
                                    <div class="w-12 h-12 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center mb-3 text-emerald-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-200 truncate max-w-[200px]" x-text="selectedFile.name"></p>
                                    <p class="text-xs text-gray-500 mt-1">Ready for ciphering &bull; <span x-text="(selectedFile.size / 1024 / 1024).toFixed(2)"></span> MB</p>
                                </div>
                            </template>

                            <template x-if="!selectedFile && !isUploading">
                                <div class="flex flex-col items-center relative z-10">
                                    <svg class="w-10 h-10 mb-3 text-gray-500 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-400"><span class="font-bold text-gray-200">Click to select</span> or drag file</p>
                                    <p class="text-xs uppercase tracking-widest font-bold text-gray-500">Max Size 20 MB</p>
                                </div>
                            </template>
                        </label>
                        
                        <div x-show="errorMessage" style="display:none;" class="text-rose-400 text-xs mt-3 block text-center font-medium" x-text="errorMessage"></div>
                    </div>

                    <!-- Alpine Progress Bar for Upload -->
                    <div x-show="isUploading" style="display: none;" class="w-full mb-6">
                        <div class="flex justify-between text-xs text-emerald-400 mb-2 font-bold uppercase tracking-widest">
                            <span>Uploading Encrypted Blob...</span>
                            <span x-text="uploadProgress + '%'"></span>
                        </div>
                        <div class="w-full bg-gray-800/80 rounded-full h-2 shadow-inner overflow-hidden">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" x-bind:style="'width: ' + uploadProgress + '%'"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button @click="processAndUpload" :disabled="!selectedFile || isUploading" class="flex-1 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-400 font-bold py-3.5 px-6 rounded-xl transition-colors border border-emerald-500/30 flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="!isUploading">Cipher & Generate URI</span>
                            <span x-show="isUploading" class="animate-pulse">Securing Payload...</span>
                            <svg x-show="!isUploading" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>
            </template>

            <!-- Success State -->
            <template x-if="uuid">
                <div class="bg-gray-900/80 backdrop-blur-md p-8 rounded-3xl border border-emerald-500/30 shadow-2xl shadow-emerald-900/10 animate-fade-in-up text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mx-auto mb-6 text-emerald-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-100 mb-2">Payload Successfully Secured!</h2>
                    <p class="text-gray-400 text-[0.9rem] mb-6">The extraction URI below contains the decryption key. It is valid for a single extraction, or automatically detonates within 24 hours.</p>
                    
                    <div class="bg-gray-950/80 border border-emerald-900/30 rounded-xl p-4 flex flex-col sm:flex-row items-center gap-3 mb-6 relative group overflow-hidden shadow-inner">
                        <div class="absolute inset-0 bg-emerald-500/5 translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500"></div>
                        <div class="w-full text-emerald-400 text-center sm:text-left text-[0.85rem] font-mono relative z-10 break-all select-all px-2 py-1 rounded" @click="copyToClipboard">
                            <span x-text="finalLink"></span>
                        </div>
                        <button @click="copyToClipboard" class="shrink-0 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-300 px-5 py-2.5 rounded-lg text-[0.8rem] font-bold tracking-wider transition-all border border-emerald-500/30 relative z-10 hover:shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                            COPY URI
                        </button>
                    </div>

                    <button @click="resetForm" class="text-gray-500 hover:text-gray-300 text-sm transition-colors">
                        Upload another payload
                    </button>
                </div>
            </template>
        </div>
    </div>

    <script>
        function vaultellaUploader() {
            return {
                selectedFile: null,
                isEncrypting: false,
                isUploading: false,
                uploadProgress: 0,
                errorMessage: '',
                keyBase64: '',
                uuid: null,
                finalLink: '',

                init() {
                    // Watch for Livewire uuid updates
                    this.$watch('$wire.uuid', value => {
                        if (value) {
                            this.uuid = value;
                            this.finalLink = window.location.origin + '/vault/' + this.uuid + '#' + this.keyBase64;
                            this.isUploading = false;
                        }
                    });
                },

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    if (file.size > 20 * 1024 * 1024) {
                        this.errorMessage = 'Payload size must not exceed 20 MB.';
                        this.selectedFile = null;
                        return;
                    }

                    this.selectedFile = file;
                    this.errorMessage = '';
                },

                async processAndUpload() {
                    if (!this.selectedFile) return;
                    this.isEncrypting = true;
                    this.errorMessage = '';

                    try {
                        // 1. Generate AES-GCM 256-bit Key
                        const key = await window.crypto.subtle.generateKey(
                            { name: "AES-GCM", length: 256 },
                            true,
                            ["encrypt", "decrypt"]
                        );

                        // Export key to Base64 for URL hash
                        const exportedKey = await window.crypto.subtle.exportKey("raw", key);
                        this.keyBase64 = btoa(String.fromCharCode(...new Uint8Array(exportedKey))).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, ''); // URL safe base64

                        // 2. Encrypt Filename
                        const filenameEncoder = new TextEncoder();
                        const filenameData = filenameEncoder.encode(this.selectedFile.name);
                        const filenameIv = window.crypto.getRandomValues(new Uint8Array(12));
                        const encryptedFilenameBuffer = await window.crypto.subtle.encrypt(
                            { name: "AES-GCM", iv: filenameIv },
                            key,
                            filenameData
                        );
                        
                        // Combine IV + Ciphertext for filename
                        const filenameCombined = new Uint8Array(filenameIv.length + encryptedFilenameBuffer.byteLength);
                        filenameCombined.set(filenameIv, 0);
                        filenameCombined.set(new Uint8Array(encryptedFilenameBuffer), filenameIv.length);
                        const encryptedFilenameBase64 = btoa(String.fromCharCode(...filenameCombined));

                        // 3. Encrypt File Content
                        const fileBuffer = await this.selectedFile.arrayBuffer();
                        const fileIv = window.crypto.getRandomValues(new Uint8Array(12));
                        const encryptedFileBuffer = await window.crypto.subtle.encrypt(
                            { name: "AES-GCM", iv: fileIv },
                            key,
                            fileBuffer
                        );

                        // 4. Create final Blob (IV + Ciphertext)
                        const finalBlob = new Blob([fileIv, encryptedFileBuffer], { type: 'application/octet-stream' });
                        const finalFile = new File([finalBlob], 'vault.dat', { type: 'application/octet-stream' });

                        // Done Encrypting
                        this.isEncrypting = false;
                        this.isUploading = true;

                        // 5. Set Encrypted Filename in Livewire
                        await this.$wire.set('encryptedFilename', encryptedFilenameBase64);

                        // 6. Upload via Livewire
                        this.$wire.upload('file', finalFile, 
                            (uploadedFilename) => {
                                // Success callback
                                this.$wire.uploadFile();
                            }, 
                            (error) => {
                                // Error callback
                                this.isUploading = false;
                                this.errorMessage = 'Failed to upload encrypted payload.';
                                console.error(error);
                            }, 
                            (event) => {
                                // Progress callback
                                this.uploadProgress = event.detail.progress;
                            }
                        );

                    } catch (e) {
                        this.isEncrypting = false;
                        this.errorMessage = 'Local encryption failure: ' + e.message;
                        console.error(e);
                    }
                },

                copyToClipboard() {
                    navigator.clipboard.writeText(this.finalLink);
                    alert('URI and Decryption Key copied to clipboard!');
                },

                resetForm() {
                    this.uuid = null;
                    this.selectedFile = null;
                    this.keyBase64 = '';
                    this.finalLink = '';
                    this.uploadProgress = 0;
                    this.$wire.set('uuid', null);
                    this.$wire.set('file', null);
                    this.$wire.set('encryptedFilename', '');
                    if (this.$refs.fileInput) {
                        this.$refs.fileInput.value = '';
                    }
                }
            }
        }
    </script>
</div>
