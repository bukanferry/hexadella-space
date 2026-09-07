<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-teal-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-teal-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-teal-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(20,184,166,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
            Shredella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight relative z-10">
            METADATA SCRUBBER
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Digital washing machine. Purge GPS coordinates, camera footprints, and classified metadata from your imagery.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "True anonymity begins by erasing footprints you didn't even realize existed."
        </p>
    </div>

    <!-- Main Container -->
    <div class="bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-10 shadow-2xl relative overflow-hidden animate-fade-in-up">
        
        @if(!$downloadPath)
            <!-- Upload Mode -->
            <div class="space-y-6"
                    x-data="{ 
                        isUploading: false, 
                        progress: 0, 
                        fileName: '', 
                        fileSize: 0, 
                        scrubbedBlob: null,
                        isScrubbing: false,
                        hasFile: false,
                        
                        handleFileSelect(event) {
                            const file = event.target.files[0];
                            if (!file) return;

                            this.fileName = file.name;
                            this.isScrubbing = true;

                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const img = new Image();
                                img.onload = () => {
                                    const canvas = document.createElement('canvas');
                                    canvas.width = img.width;
                                    canvas.height = img.height;
                                    const ctx = canvas.getContext('2d');
                                    ctx.drawImage(img, 0, 0);

                                    canvas.toBlob((blob) => {
                                        this.scrubbedBlob = blob;
                                        this.fileSize = blob.size;
                                        this.isScrubbing = false;
                                        this.hasFile = true;
                                    }, 'image/jpeg', 0.92);
                                };
                                img.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        },
                        
                        uploadScrubbed() {
                            if (!this.scrubbedBlob) return;
                            this.isUploading = true;
                            
                            const scrubbedFile = new File([this.scrubbedBlob], 'sterilized_' + this.fileName, { type: 'image/jpeg' });
                            
                            $wire.upload('photo', scrubbedFile, (uploadedFilename) => {
                                this.isUploading = false;
                                $wire.scrub(); // Call server to finalize
                            }, () => {
                                this.isUploading = false;
                                alert('Upload failure.');
                            }, (event) => {
                                this.progress = event.detail.progress;
                            });
                        }
                    }">
                <!-- Dropzone Area -->
                <div class="relative group">
                    
                    <input type="file" @change="handleFileSelect" accept="image/jpeg,image/png,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" title="Click or drag image here">
                    
                    <div class="border-2 border-dashed rounded-3xl p-10 text-center transition-all duration-300" :class="hasFile ? 'border-teal-500/50 bg-teal-500/5' : 'border-gray-700 hover:border-teal-500/50 hover:bg-gray-800/50'">
                        <div x-show="hasFile" style="display: none;" class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-teal-500/20 text-teal-400 rounded-full flex items-center justify-center mb-4">
                                <svg x-show="!isScrubbing" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="isScrubbing" class="animate-spin w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-200 mb-1" x-text="isScrubbing ? 'Scrubbing Metadata...' : 'Image Ready for Upload!'"></h3>
                            <p class="text-teal-500 text-sm font-medium" x-text="fileName + ' (' + (fileSize / 1024).toFixed(2) + ' KB)'"></p>
                        </div>
                        
                        <div x-show="!hasFile" class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-600 group-hover:text-teal-500/70 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <h3 class="text-lg font-bold text-gray-300 mb-2">Select Image or Drag Here</h3>
                            <p class="text-gray-500 text-sm">Supports JPG, PNG, WEBP (Max 15MB)</p>
                            <p class="text-teal-500/50 text-xs mt-2 italic">*Scrubbing is executed entirely on your device.</p>
                        </div>

                        <!-- Alpine Progress Bar -->
                        <div x-show="isUploading" style="display: none;" class="w-full max-w-sm mx-auto mt-4">
                            <div class="flex justify-between text-xs text-teal-400 mb-2 font-bold uppercase tracking-widest">
                                <span>Uploading Scrubbed File...</span>
                                <span x-text="progress + '%'"></span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-2 shadow-inner overflow-hidden">
                                <div class="bg-teal-500 h-2 rounded-full transition-all duration-300" x-bind:style="'width: ' + progress + '%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @error('photo') 
                    <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-xl text-sm font-medium text-center">
                        {{ $message }}
                    </div>
                @enderror
                
                @if($errorMsg)
                    <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-xl text-sm font-medium text-center">
                        {{ $errorMsg }}
                    </div>
                @endif

                <!-- Scrub Action Button -->
                <div x-show="hasFile" style="display: none;" class="pt-6 border-t border-gray-800">
                    <button @click="uploadScrubbed" :disabled="isUploading || isScrubbing" class="w-full bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-500 hover:to-teal-400 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-[0_0_20px_rgba(20,184,166,0.3)] hover:shadow-[0_0_30px_rgba(20,184,166,0.5)] border border-teal-400/20 uppercase tracking-widest text-sm flex items-center justify-center gap-2 group disabled:opacity-50 disabled:cursor-wait">
                        <span x-show="!isUploading && !isScrubbing">Upload & Finalize</span>
                        <span x-show="isUploading || isScrubbing">Processing...</span>
                        <svg x-show="!isUploading && !isScrubbing" class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </button>
                </div>
            </div>
        @else
            <!-- Success / Download Mode -->
            <div class="text-center py-8">
                <div class="w-24 h-24 rounded-full bg-teal-900/30 border border-teal-500/30 flex items-center justify-center mx-auto mb-6 shadow-[0_0_30px_rgba(20,184,166,0.2)]">
                    <svg class="w-12 h-12 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-100 mb-4 tracking-tight">Image Sterilized!</h2>
                <p class="text-gray-400 text-sm md:text-base font-light max-w-md mx-auto leading-relaxed mb-8">
                    All EXIF metadata, GPS coordinates, color profiles, and device information have been successfully incinerated without a trace.
                </p>
                
                <div class="flex flex-col gap-4 max-w-xs mx-auto">
                    <button wire:click="downloadAndDestroy" class="w-full bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-500 hover:to-teal-400 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-[0_0_20px_rgba(20,184,166,0.3)] hover:shadow-[0_0_30px_rgba(20,184,166,0.5)] border border-teal-400/20 uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                        Download & Incinerate
                        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </button>
                    <button wire:click="$set('downloadPath', null)" class="px-6 py-3 bg-transparent hover:bg-gray-800 text-gray-400 hover:text-gray-200 font-bold rounded-xl text-xs uppercase tracking-widest transition-colors border border-gray-700">
                        Abort / Scrub Another File
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>
