<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-amber-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-amber-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(245,158,11,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            Dropella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight relative z-10">
            BLIND DROP ZONE
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Establish a blind drop zone to receive payloads from the public with absolute anonymity.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "In the abyss of the digital realm, this vessel receives without questioning, and stores without observing."
        </p>
    </div>

    <!-- Main Form -->
    <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up">
        @if($createdBox)
            <div class="text-center py-6">
                <div class="w-20 h-20 rounded-full bg-amber-900/30 border border-amber-500/30 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-100 mb-2">Drop Zone Successfully Established!</h2>
                <p class="text-gray-400 text-sm mb-8 max-w-md mx-auto">
                    This zone will be systematically incinerated on {{ $createdBox->expires_at->format('d M Y H:i') }}. Safeguard the following credentials with extreme prejudice.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto text-left">
                    <!-- Public URL -->
                    <div class="bg-gray-950 p-5 rounded-2xl border border-gray-800">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-full bg-cyan-900/30 flex items-center justify-center text-cyan-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-200">Public URI</h3>
                        </div>
                        <p class="text-xs text-gray-500 mb-4">Distribute this to the public or your informants. They possess solely upload privileges.</p>
                        <div class="flex items-center gap-2 bg-gray-900 p-2 rounded-xl border border-gray-700" x-data="{ copied: false }">
                            <input type="text" readonly value="{{ url('/d/' . $createdBox->public_slug) }}" class="w-full bg-transparent border-none text-cyan-400 text-sm font-mono focus:ring-0" x-ref="pubLink">
                            <button @click="navigator.clipboard.writeText($refs.pubLink.value); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg text-xs font-bold transition-colors">
                                <span x-text="copied ? 'Copied' : 'Copy'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Secret Key -->
                    <div class="bg-gray-950 p-5 rounded-2xl border border-amber-500/30 shadow-[0_0_15px_rgba(245,158,11,0.05)]">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-full bg-amber-900/30 flex items-center justify-center text-amber-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            </div>
                            <h3 class="font-bold text-amber-500">Secret Key & Dashboard</h3>
                        </div>
                        <p class="text-xs text-gray-500 mb-4">Utilize this secret key within the dashboard to breach the vault and extract payloads.</p>
                        
                        <div class="flex items-center gap-2 bg-gray-900 p-2 rounded-xl border border-amber-500/20 mb-3" x-data="{ copied: false }">
                            <input type="text" readonly value="{{ $secretKey }}" class="w-full bg-transparent border-none text-amber-400 text-sm font-mono focus:ring-0" x-ref="secKey">
                            <button @click="navigator.clipboard.writeText($refs.secKey.value); copied = true; setTimeout(() => copied = false, 2000)" class="px-4 py-2 bg-amber-600/20 hover:bg-amber-600/40 text-amber-500 rounded-lg text-xs font-bold transition-colors">
                                <span x-text="copied ? 'Copied' : 'Copy'"></span>
                            </button>
                        </div>

                        <a href="{{ url('/d/' . $createdBox->public_slug . '/unlock') }}" target="_blank" class="block text-center w-full py-2 bg-amber-600 hover:bg-amber-500 text-gray-900 font-bold text-xs rounded-xl transition-all">
                            Access Dashboard
                        </a>
                    </div>
                </div>
                
                <button wire:click="$set('createdBox', null)" class="mt-8 text-gray-500 hover:text-amber-400 text-sm font-medium transition-colors">
                    Establish New Zone
                </button>
            </div>
        @else
            <form wire:submit.prevent="createBox" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Designation (Optional, public-facing)</label>
                    <input type="text" wire:model="title" class="w-full bg-gray-950/50 border border-gray-800 rounded-xl px-4 py-3 text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all" placeholder="e.g. Project X Investigation Assets">
                    @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Incinerate all payloads within this zone in</label>
                        <select wire:model="expiresIn" class="w-full bg-gray-950/50 border border-gray-800 rounded-xl px-4 py-3 text-gray-300 focus:outline-none focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all appearance-none cursor-pointer">
                            <option value="1">1 Day</option>
                            <option value="3">3 Days</option>
                            <option value="7">7 Days</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-gray-900 font-bold py-3.5 px-4 rounded-xl transition-all shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_30px_rgba(245,158,11,0.5)] flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Establish Drop Zone
                        </button>
                    </div>
                </div>
            </form>
            
            <!-- Warning -->
            <div class="mt-8 pt-6 border-t border-gray-800 flex items-start gap-4 p-4 rounded-xl bg-gray-950/50">
                <div class="w-10 h-10 rounded-full bg-amber-900/30 flex items-center justify-center flex-shrink-0 text-amber-500 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-200 mb-1">Server & Privacy Defenses</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        The architecture is "blind". The creator remains ignorant of the transmitter's IP, and the transmitter is oblivious to previous uploaders. Filenames and MIME types are AES-256 encrypted within the database. Maximum payload size is 10 MB.
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
