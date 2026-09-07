<x-layouts.app>
    <div class="flex flex-col items-center pt-10 pb-20 text-center relative z-10">
        <!-- Logo -->
        <div class="mb-8 flex justify-center mx-auto opacity-0 animate-fade-in-up" style="animation-delay: 0.1s;">
            <img src="{{ asset('img/hexadellaspace.png') }}" alt="Hexadella Space" class="h-32 md:h-44 object-contain drop-shadow-[0_0_25px_rgba(168,85,247,0.3)]" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIj48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSI0MCIgZmlsbD0iIzhCNUNGNiIgLz48L3N2Zz4='">
        </div>
        
        <!-- Headers -->
        
        <h1 class="text-lg md:text-xl text-gray-300 font-light max-w-3xl leading-relaxed mb-3 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
            Identity-free communication infrastructure. Designed to self-destruct immediately after use.
        </h1>
        
        <p class="text-purple-400 font-bold tracking-wide opacity-0 animate-fade-in-up mb-8" style="animation-delay: 0.3s;">
            Zero Logs &bull; Zero Footprint &bull; Pure Privacy.
        </p>

        <!-- Ecosystem Guide CTA -->
        <div class="opacity-0 animate-fade-in-up mb-6 z-20 relative" style="animation-delay: 0.4s;">
            <a href="{{ route('manual') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 border border-gray-700 hover:border-gray-500 text-gray-300 hover:text-white rounded-full font-sans text-sm font-semibold transition-all shadow-[0_0_15px_rgba(255,255,255,0.02)] hover:shadow-[0_0_20px_rgba(255,255,255,0.05)] group">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Ecosystem Manual
                <svg class="w-4 h-4 translate-x-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-[1200px] opacity-0 animate-fade-in-up px-4" style="animation-delay: 0.5s;">
            <!-- Card 1: Whisperella -->
            <a href="{{ route('whisperella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl shadow-purple-900/10 hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-purple-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-purple-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <!-- Icon Box -->
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-purple-400 shadow-sm group-hover:bg-purple-900/30 group-hover:border-purple-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-purple-300 transition-colors">Whisperella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-purple-500/10 rounded-md text-[0.65rem] font-bold text-purple-400 uppercase tracking-wider mb-3 border border-purple-500/20">In-Memory Private Chat</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Ephemeral RAM-based chat room. All sessions and conversation histories are automatically destroyed upon disconnection.
                    </p>
                </div>
            </a>

            <!-- Card 2: Pollella -->
            <a href="{{ route('pollella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl shadow-blue-900/10 hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-blue-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-blue-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-blue-400 shadow-sm group-hover:bg-blue-900/30 group-hover:border-blue-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-blue-300 transition-colors">Pollella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-purple-500/10 rounded-md text-[0.65rem] font-bold text-purple-400 uppercase tracking-wider mb-3 border border-purple-500/20">Zero-ID Opinion Polls</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Public surveys and voting without identity tracking, featuring anti-sybil mechanisms and automatic expiration parameters.
                    </p>
                </div>
            </a>

            <!-- Card 3: Vaultella -->
            <a href="{{ route('vaultella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-emerald-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-emerald-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-emerald-400 shadow-sm group-hover:bg-emerald-900/30 group-hover:border-emerald-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-emerald-300 transition-colors">Vaultella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-emerald-500/10 rounded-md text-[0.65rem] font-bold text-emerald-400 uppercase tracking-wider mb-3 border border-emerald-500/20">Secure Data Store</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Encrypted data payload storage. Manage sensitive information with absolute client-side encryption logic.
                    </p>
                </div>
            </a>

            <!-- Card 4: Havenella -->
            <a href="{{ route('havenella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl shadow-amber-900/10 hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-amber-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-amber-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-amber-500 shadow-sm group-hover:bg-amber-900/30 group-hover:border-amber-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-amber-300 transition-colors">Havenella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-amber-500/10 rounded-md text-[0.65rem] font-bold text-amber-400 uppercase tracking-wider mb-3 border border-amber-500/20">Ephemeral Public Board</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Decentralized public opinion board, featuring autonomous complete data sweeps every 7 days.
                    </p>
                </div>
            </a>

            <!-- Card 5: Maskella -->
            <a href="{{ route('maskella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-rose-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-rose-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-rose-400 shadow-sm group-hover:bg-rose-900/30 group-hover:border-rose-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-rose-300 transition-colors">Maskella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-rose-500/10 rounded-md text-[0.65rem] font-bold text-rose-400 uppercase tracking-wider mb-3 border border-rose-500/20">Zero-Account Inbox</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Anonymous Q&A inbox. Utilizes passwordless cryptographic tokens, vanishing automatically after 30 days of inactivity.
                    </p>
                </div>
            </a>

            <!-- Card 6: Notella -->
            <a href="{{ route('notella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-cyan-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-cyan-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-cyan-400 shadow-sm group-hover:bg-cyan-900/30 group-hover:border-cyan-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-cyan-300 transition-colors">Notella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-cyan-500/10 rounded-md text-[0.65rem] font-bold text-cyan-400 uppercase tracking-wider mb-3 border border-cyan-500/20">Burn-After-Reading Note</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Transmit encrypted secret messages. The payload detonates and vanishes from the server the exact millisecond it is read.
                    </p>
                </div>
            </a>

            <!-- Card 7: Dropella -->
            <a href="{{ route('dropella.index') }}" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-amber-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-amber-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-amber-500 shadow-sm group-hover:bg-amber-900/30 group-hover:border-amber-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-amber-300 transition-colors">Dropella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-amber-500/10 rounded-md text-[0.65rem] font-bold text-amber-400 uppercase tracking-wider mb-3 border border-amber-500/20">Blind Drop Zone</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Anonymous digital dead drop. Anyone can drop a file, but only you, the key holder, can decrypt and extract it.
                    </p>
                </div>
            </a>

            <!-- Card 8: Splitella -->
            <a href="/splitella" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-pink-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-pink-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-pink-500 shadow-sm group-hover:bg-pink-900/30 group-hover:border-pink-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-pink-300 transition-colors">Splitella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-pink-500/10 rounded-md text-[0.65rem] font-bold text-pink-400 uppercase tracking-wider mb-3 border border-pink-500/20">Shamir's Secret Sharing</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Shatter a secret into multiple cryptographic shards. Recombine them meeting the minimum threshold to decrypt.
                    </p>
                </div>
            </a>

            <!-- Card 9: Shredella -->
            <a href="/shredella" class="w-full p-6 text-left bg-gray-900/80 rounded-[1.5rem] shadow-xl hover:scale-[1.03] transition-all duration-300 relative group overflow-hidden border border-gray-800 backdrop-blur-sm cursor-pointer block hover:border-teal-500/30 flex flex-col min-h-[220px]">
                <!-- Watermark -->
                <svg class="absolute -right-2 -bottom-2 w-24 h-24 text-gray-800/40 group-hover:text-teal-900/20 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                
                <div class="relative z-10 flex flex-col h-full flex-grow">
                    <div class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center mb-4 text-teal-500 shadow-sm group-hover:bg-teal-900/30 group-hover:border-teal-500/30 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-100 tracking-tight mb-2 group-hover:text-teal-300 transition-colors">Shredella</h3>
                    <span class="inline-block self-start px-2 py-1 bg-teal-500/10 rounded-md text-[0.65rem] font-bold text-teal-400 uppercase tracking-wider mb-3 border border-teal-500/20">Metadata Scrubber</span>
                    <p class="text-sm text-gray-400 leading-relaxed font-light mt-auto">
                        Digital sanitizer. Strip GPS coordinates, EXIF data, camera footprints, and hidden metadata from your visual assets.
                    </p>
                </div>
            </a>
        </div>
    </div>
</x-layouts.app>
