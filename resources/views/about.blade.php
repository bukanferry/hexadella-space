<x-layouts.app title="Manifesto - Hexadella Space">
    <div class="max-w-5xl mx-auto px-4 py-12 relative min-h-screen flex flex-col">
        <!-- Background Effects -->
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-900/10 via-gray-950 to-gray-950"></div>
        <div class="fixed top-[20%] left-[-10%] w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[120px] animate-float pointer-events-none -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[150px] animate-float-delayed pointer-events-none -z-10"></div>

        <!-- 1. Hero / Title Section -->
        <div class="text-center mb-32 relative mt-16 animate-fade-in-up">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl"></div>
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-900/80 border border-purple-500/30 text-purple-400 text-xs font-bold tracking-widest uppercase mb-8 shadow-[0_0_20px_rgba(168,85,247,0.1)] relative z-10 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                // MANIFESTO & PRIVACY CORE
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 via-gray-300 to-gray-500 mb-10 tracking-tight relative z-10 max-w-4xl mx-auto leading-tight">
                "A System Architected to Trust No One — <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-indigo-400">Including Its Creator.</span>"
            </h1>
            
            <p class="text-gray-400 text-lg md:text-xl font-light max-w-3xl mx-auto leading-relaxed relative z-10 mt-6">
                Hexadella Space was forged from a singular conviction: true privacy stems not from moral promises or written policies, but from <strong class="text-gray-200 font-semibold">a system architecture that makes eavesdropping technically impossible.</strong> A privacy ecosystem governed by <strong class="text-gray-200 font-semibold">Zero-Knowledge Architecture</strong>, enforcing strict data impermanence through an automated <strong class="text-purple-400 font-semibold italic">Burn-After-Use</strong> mechanism.
            </p>
        </div>
        
        <!-- 2. Three Pillars of Zero-Knowledge -->
        <div class="mt-16 mb-24 relative z-10">
            <h2 class="text-2xl font-bold text-center text-gray-100 mb-12 tracking-tight uppercase">The Three Core Pillars</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Pillar 1 -->
                <div class="bg-gray-900/60 backdrop-blur-md p-8 rounded-3xl border border-gray-800 hover:border-purple-500/30 transition-all duration-300 shadow-xl group">
                    <div class="w-12 h-12 rounded-2xl bg-gray-950 border border-gray-800 flex items-center justify-center mb-6 text-purple-400 group-hover:bg-purple-500/10 group-hover:scale-110 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="flex flex-col text-xl font-bold text-gray-100 mb-3 group-hover:text-purple-300 transition-colors">
                        Zero Data Intervention
                        <span class="text-sm font-medium text-gray-500 mt-1">(Zero Management)</span>
                    </h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        We do not manage, modify, or inspect the database. All structured data operates on a lifecycle measured in seconds and hours, never years. Once thresholds or expirations are met, termination protocols execute autonomously from deep within the engine, requiring zero human intervention.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-gray-900/60 backdrop-blur-md p-8 rounded-3xl border border-gray-800 hover:border-indigo-500/30 transition-all duration-300 shadow-xl group">
                    <div class="w-12 h-12 rounded-2xl bg-gray-950 border border-gray-800 flex items-center justify-center mb-6 text-indigo-400 group-hover:bg-indigo-500/10 group-hover:scale-110 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="flex flex-col text-xl font-bold text-gray-100 mb-3 group-hover:text-indigo-300 transition-colors">
                        Zero Access & Blindness
                        <span class="text-sm font-medium text-gray-500 mt-1">(Absolute Blindness)</span>
                    </h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        We cannot peek into a single byte of data. All your communications and files are unconditionally ciphered before they ever touch our network. This server is engineered to be a blind entity, merely transporting meaningless digital static. We provide no backdoors, because logically, we do not possess the keys.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-gray-900/60 backdrop-blur-md p-8 rounded-3xl border border-gray-800 hover:border-emerald-500/30 transition-all duration-300 shadow-xl group">
                    <div class="w-12 h-12 rounded-2xl bg-gray-950 border border-gray-800 flex items-center justify-center mb-6 text-emerald-400 group-hover:bg-emerald-500/10 group-hover:scale-110 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="flex flex-col text-xl font-bold text-gray-100 mb-3 group-hover:text-emerald-300 transition-colors">
                        The Autonomous Vessel
                        <span class="text-sm font-medium text-gray-500 mt-1">(The Self-Sustaining Vessel)</span>
                    </h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Our role concludes the moment this system compiles. From then on, the platform sails on its own. We merely laid the codebase and defense mechanisms. This space operates autonomously, hosting transient interactions that arrive and vanish back into the void, with no requirement for us to monitor where the current flows.
                    </p>
                </div>
            </div>
        </div>

        <!-- 3. Architectural Transparency (All Features) -->
        <div class="mt-12 mb-24 relative z-10 max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-gray-100 mb-4 tracking-tight uppercase">Architectural Transparency</h2>
            <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto text-sm">Adhering to Kerckhoffs's Principle, we assert that true security is born from system transparency, not by obfuscating its mechanics (Security through Obscurity).</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Notella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Notella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> Messages are encrypted locally via <i>AES-GCM</i>. The server only retains a base-64 ciphertext and a trigger. The moment the link is accessed and the payload is fetched, the trigger issues an irrevocable hard-delete command to the database, ensuring destruction before your browser even decrypts it.</p>
                </div>

                <!-- Shredella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Shredella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> Upon upload, the memory module strips all native file metadata (EXIF, original name, dimension tags). The asset is then overwritten with zero-fill or random-fill binary data three consecutive times on the storage sector, mathematically guaranteeing the impossibility of forensic recovery.</p>
                </div>

                <!-- Splitella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Splitella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> Deploys the <i>Shamir's Secret Sharing (SSS)</i> cryptographic algorithm entirely Client-Side in JavaScript. Your master secret is mapped onto a random polynomial equation, fracturing it into multi-point coordinates (shards). Without assembling the predefined minimum threshold of coordinates, reconstruction remains mathematically impossible.</p>
                </div>

                <!-- Vaultella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Vaultella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> The file is buffered into browser RAM (<i>ArrayBuffer</i>) and subjected to pixel-by-pixel encryption using the <i>Web Crypto API (AES-GCM)</i>. The 256-bit decryption key is tethered strictly to the URL Hash (`#`), a component natively never transmitted to the server. The server exclusively hosts dead `.dat` files, assuring absolute E2EE isolation.</p>
                </div>

                <!-- Whisperella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Whisperella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> WebSocket streams are routed through a <i>Reverb/Redis</i> relay, carrying payloads (text & imagery) that are already client-side E2EE ciphered. The server acts strictly as a <i>Blind Relay</i>. All chatter exists purely in isolated RAM (Redis) governed by aggressive Time-To-Live (TTL) cycles, dissolving into the void without a trace.</p>
                </div>

                <!-- Dropella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Dropella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> The <i>Secure Drop</i> infrastructure relies on one-way database schemas. Depositors possess absolute "Write-Only" clearance, incapable of retrieving box contents. The Receiver retains single-read authorization unlocked by a cryptographic key. The instant a deposit is extracted, the <i>shredder</i> protocol obliterates the payload from the sector.</p>
                </div>

                <!-- Maskella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Maskella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> This module enforces visual intervention at the browser level (<i>HTML5 Canvas</i>) to manipulate pixel arrays (blurring/censorship). Parallelly, <i>Metadata Stripping</i> executes prior to re-encoding, ensuring zero residual GPS coordinates or device serial signatures contaminate the final EXIF profile of the output asset.</p>
                </div>

                <!-- Pollella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Pollella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> Blind polling executes entirely devoid of IP logging or Session ID tracking. Every incoming vote is channeled through a <i>One-Way Cryptographic Hash Function</i>. The vote aggregation utilizes <i>Blind Aggregation</i> logic, rendering it computationally infeasible to map a specific candidate selection to an individual browser fingerprint.</p>
                </div>

                <!-- Havenella -->
                <div class="bg-gray-900/40 backdrop-blur-sm p-6 rounded-2xl border border-gray-800/50 hover:border-gray-600 transition-colors">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-200">Havenella</h4>
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed"><strong>Logic:</strong> Havenella functions as a <i>Secure Enclave</i>. The system deploys network segregation where distribution links are purely <i>Ephemeral</i> (valid within tight temporal limits and detonated post-access). Sheltered data is subjected to aggressive memory-storage rotation, ruthlessly minimizing the statistical probability of <i>data recovery</i>.</p>
                </div>
                
            </div>
        </div>

        <!-- 4. Minimalist CTA -->
        <div class="mt-auto pb-12 text-center relative z-10 animate-fade-in-up" style="animation-delay: 0.5s;">
            <a href="/" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-2xl transition-all duration-300 hover:scale-105 hover:shadow-[0_0_30px_rgba(168,85,247,0.4)] border border-purple-400/30 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="text-[0.95rem]">Return to Space</span>
            </a>
        </div>
    </div>
</x-layouts.app>
